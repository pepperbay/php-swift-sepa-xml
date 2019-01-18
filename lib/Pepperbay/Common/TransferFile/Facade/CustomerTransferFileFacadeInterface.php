<?php
/**
 * SEPA file generator.
 *
 * @copyright © Pepperbay <www.digitick.net> 2012-2013
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

namespace Pepperbay\Common\TransferFile\Facade;

use Pepperbay\Common\PaymentInformation;
use Pepperbay\Common\TransferInformation\TransferInformationInterface;

interface CustomerTransferFileFacadeInterface
{
    /**
     * @param $payment
     * @param array $paymentInformation
     *
     * @return PaymentInformation
     */
    public function addPaymentInfo($payment, array $paymentInformation);

    /**
     * @param $payment
     * @param array $transferInformation
     *
     * @return TransferInformationInterface
     */
    public function addTransfer($payment, array $transferInformation);

    /**
     * @return string
     */
    public function asXML();
}
