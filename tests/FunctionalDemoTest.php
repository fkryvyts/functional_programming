<?php
/**
 * Created by PhpStorm.
 * Author: garcher
 * Date: 12.12.16
 * Time: 03:12
 */

use Unity\FunctionalDemo\Helper\ContactInformation;
use Unity\FunctionalDemo\Helper\ContactInformationRepository;
use Unity\FunctionalDemo\Helper\Order\Basket;
use Unity\FunctionalDemo\Helper\Order\Product;

use PhpSlang\Collection\ListCollection;
use Money\Money;
use Money\Currency;
use PHPUnit\Framework\TestCase;

class FunctionalDemoTest extends TestCase
{
    public function testOptional()
    {
        $contactInformationRepository = $this->initContactInformationRepository();

        $country = $contactInformationRepository->getContactInformation('Santa Claus')
            ->map(function(ContactInformation $contactInformation) {
                return $contactInformation->getCountry();
            })
            ->getOrCall(function() {
                throw new \Exception('contact data is missing');
            });

        $this->assertEquals('Finland', $country);
    }

    public function testList()
    {
        $contactInformation = $this->initContactInformationRepository()
            ->getContactInformation('Santa Claus')->getOrElse(null);

        $productsList = new ListCollection([
            new Product('78340', 'Biustonosz Nipplex Adriana Push-up', new Money(6685, new Currency('PLN'))),
            new Product('PR-WTZ-08-50', 'Wąż WTZ 8x12,5 mm', new Money(458, new Currency('PLN')), 2),
            new Product('TG-115E-032', 'Kompensator gumowy typ 115 EPDM, DN32, PN10/16', new Money(10924, new Currency('PLN'))),
        ]);

        $basket = new Basket($contactInformation, $productsList);
        $result = $basket->getProducts()->has(function(Product $product) {
           return $product->getCode() == 'PR-WTZ-08-50';
        });

        $this->assertEquals(true, $result);

        $result = $basket->getProducts()->has(function(Product $product) {
            return $product->getCode() == 'deer';
        });

        $this->assertEquals(false, $result);

        $hoseName = $basket->getProducts()->any(function(Product $product) {
            return $product->getCode() == 'PR-WTZ-08-50';
        })->map(function(Product $product){
            return $product->getName();
        })->getOrElse(null);

        $this->assertEquals('Wąż WTZ 8x12,5 mm', $hoseName);

        $totalAmount = $basket->getProducts()->map(function(Product $product) {
            return $product->getPrice()->multiply($product->getAmount());
        })->foldLeft(new Money(0, new Currency('PLN')), function(Money $accumulated, Money $current) {
            return $accumulated->add($current);
        });

        $targetAmount = new Money(18525, new Currency('PLN'));
        $this->assertEquals(true, $targetAmount->equals($totalAmount));

        $head = $basket->getProducts()->head();
        $this->assertEquals(new Product('78340', 'Biustonosz Nipplex Adriana Push-up', new Money(6685, new Currency('PLN'))), $head);

        $everyThirdProduct = $basket->getProducts()->withEvery(3);

        $this->assertEquals(new ListCollection([
            new Product('TG-115E-032', 'Kompensator gumowy typ 115 EPDM, DN32, PN10/16', new Money(10924, new Currency('PLN'))),
        ]), $everyThirdProduct);
    }

    /**
     * @return ContactInformationRepository
     */
    private function initContactInformationRepository() : ContactInformationRepository
    {
        $contactInformationRepository = new ContactInformationRepository();
        $contactInformationRepository->addContactInformation('Santa Claus', new ContactInformation(
            'Santa Claus Main Post Office',
            'Arctic Circle',
            'Finland',
            'FI-96930'
        ));

        return $contactInformationRepository;
    }

}