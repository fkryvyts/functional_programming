<?php
/**
 * Created by PhpStorm.
 * Author: garcher
 * Date: 12.12.16
 * Time: 03:04
 */

namespace Unity\FunctionalDemo\Helper;

use PhpSlang\Option\Option;
use PhpSlang\Option\Some;

class ContactInformationRepository
{
    /** @var array */
    private $contactInformations = [];

    /**
     * @param string $userName
     * @param ContactInformation $information
     */
    public function addContactInformation(string $userName, ContactInformation $information)
    {
        $this->contactInformations[$userName] = $information;
    }

    /**
     * @param string $userName
     * @return Option
     */
    public function getContactInformation(string $userName) : Option
    {
        return Some::of($this->contactInformations[$userName] ?: null);
    }
}