<?php
/**
 * Created by PhpStorm.
 * Author: sa10
 * Date: 12.12.16
 * Time: 03:12
 */

use Unity\FunctionalDemo\Helper\ContactInformation;
use Unity\FunctionalDemo\Helper\ContactInformationRepository;

use PHPUnit\Framework\TestCase;

class FunctionalDemoTest extends TestCase
{
    public function testOptional()
    {
        $contactInformationRepository = new ContactInformationRepository();
        $contactInformationRepository->addContactInformation('Santa Claus', new ContactInformation(
            'Santa Claus Main Post Office',
            'Arctic Circle',
            'Finland',
            'FI-96930'
        ));

        $country = $contactInformationRepository->getContactInformation('Santa Claus')
            ->map(function(ContactInformation $contactInformation) {
                return $contactInformation->getCountry();
            })
            ->getOrCall(function() {
                throw new \Exception('contact data is missing');
            });

        $this->assertEquals('Finland', $country);
    }
}