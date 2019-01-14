<?php
/**
 * SEPA file generator.
 *
 * @copyright © Digitick <www.digitick.net> 2012-2013
 * @copyright © Blage <www.blage.net> 2013
 * @license GNU Lesser General Public License v3.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Lesser Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Digitick\Swift\DomBuilder;

use Digitick\Sepa\TransferInformation\CustomerDirectDebitTransferInformation;
use Digitick\Sepa\TransferInformation\TransferInformationInterface;
use Digitick\Sepa\PaymentInformation;
use Digitick\Sepa\TransferFile\TransferFileInterface;
use Digitick\Common\GroupHeader;
use Digitick\Common\DomBuilder\BaseDomBuilder;

/** @TODO */
class CustomerDirectDebitTransferDomBuilder extends BaseDomBuilder
{
    /**
     * Build the root of the document
     *
     * @param  TransferFileInterface $transferFile
     * @return mixed
     */
    public function visitTransferFile(TransferFileInterface $transferFile)
    {
        //TODO
    }

    /**
     * Crawl PaymentInformation containing the Transactions
     *
     * @param  PaymentInformation $paymentInformation
     * @return mixed
     */
    public function visitPaymentInformation(PaymentInformation $paymentInformation)
    {
        //TODO
    }

    /**
     * Crawl Transactions
     *
     * @param  TransferInformationInterface $transactionInformation
     * @return mixed
     */
    public function visitTransferInformation(TransferInformationInterface $transactionInformation)
    {
        //TODO
    }

    /**
     * Add the specific OrgId element for the format 'pain.008.001.02'
     *
     * @param  GroupHeader $groupHeader
     * @return mixed
     */
    public function visitGroupHeader(GroupHeader $groupHeader)
    {
        //TODO
    }
}
