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

use Pepperbay\Common\Exception\InvalidArgumentException;
use Pepperbay\Common\PaymentInformation;
use Pepperbay\Common\TransferInformation\CustomerDirectDebitTransferInformation;
use Pepperbay\Common\TransferInformation\TransferInformationInterface;

class CustomerDirectDebitFacade extends BaseCustomerTransferFileFacade
{
    /**
     * @param $paymentName
     * @param array $paymentInformation
     *                                  - id
     *                                  - creditorName
     *                                  - creditorAccountIBAN
     *                                  - creditorAgentBIC
     *                                  - seqType
     *                                  - creditorId
     *                                  - [dueDate] if not set: now + 5 days
     *
     * @throws \Pepperbay\Sepa\Exception\InvalidArgumentException
     *
     * @return PaymentInformation
     */
    public function addPaymentInfo($paymentName, array $paymentInformation)
    {
        if (isset($this->payments[$paymentName])) {
            throw new InvalidArgumentException(sprintf('Payment with the name %s already exists', $paymentName));
        }

        $creditorAgentBIC = (isset ($paymentInformation['creditorAgentBIC'])) ? $paymentInformation['creditorAgentBIC'] : null;

        $payment = new PaymentInformation(
            $paymentInformation['id'],
            $paymentInformation['creditorAccountIBAN'],
            $creditorAgentBIC,
            $paymentInformation['creditorName']
        );

        $payment->setSequenceType($paymentInformation['seqType']);
        $payment->setCreditorId($paymentInformation['creditorId']);
        $payment->setDueDate($this->createDueDateFromPaymentInformation($paymentInformation, '+5 day'));

        if (isset($paymentInformation['localInstrumentCode'])) {
            $payment->setLocalInstrumentCode($paymentInformation['localInstrumentCode']);
        }

        if (isset($paymentInformation['instructionPriority'])) {
            $payment->setInstructionPriority($paymentInformation['instructionPriority']);
        }

        $this->payments[$paymentName] = $payment;

        return $payment;
    }

    /**
     * @param $paymentName
     * @param array $transferInformation
     *                                   - amount
     *                                   - debtorIban
     *                                   - debtorBic
     *                                   - debtorName
     *                                   - debtorMandate
     *                                   - debtorMandateSignDate
     *                                   - remittanceInformation
     *                                   - [endToEndId]
     *                                   - [amendments]
     *                                   - [debtorCountry]
     *                                   - [debtorAdrLine]
     *
     * @throws \Pepperbay\Sepa\Exception\InvalidArgumentException
     *
     * @return TransferInformationInterface
     */
    public function addTransfer($paymentName, array $transferInformation)
    {
        if (!isset($this->payments[$paymentName])) {
            throw new InvalidArgumentException(sprintf(
                'Payment with the name %s does not exists, create one first with addPaymentInfo',
                $paymentName
            ));
        }
        $transfer = new CustomerDirectDebitTransferInformation(
            $transferInformation['amount'],
            $transferInformation['debtorIban'],
            $transferInformation['debtorName']
        );

        if (isset($transferInformation['debtorBic'])) {
            $transfer->setBic($transferInformation['debtorBic']);
        }

        $transfer->setMandateId($transferInformation['debtorMandate']);
        if ($transferInformation['debtorMandateSignDate'] instanceof \DateTime) {
            $transfer->setMandateSignDate($transferInformation['debtorMandateSignDate']);
        } else {
            $transfer->setMandateSignDate(new \DateTime($transferInformation['debtorMandateSignDate']));
        }

        if (isset($transferInformation['creditorReference'])) {
            $transfer->setCreditorReference($transferInformation['creditorReference']);
        } else {
            $transfer->setRemittanceInformation($transferInformation['remittanceInformation']);
        }

        if (isset($transferInformation['endToEndId'])) {
            $transfer->setEndToEndIdentification($transferInformation['endToEndId']);
        } else {
            $transfer->setEndToEndIdentification(
                $this->payments[$paymentName]->getId() . count($this->payments[$paymentName]->getTransfers())
            );
        }
        if (isset($transferInformation['originalMandateId'])) {
            $transfer->setOriginalMandateId($transferInformation['originalMandateId']);
        }
        if (isset($transferInformation['originalDebtorIban'])) {
            $transfer->setOriginalDebtorIban($transferInformation['originalDebtorIban']);
        }
        if (isset($transferInformation['amendedDebtorAccount'])) {
            $transfer->setAmendedDebtorAccount((bool) $transferInformation['amendedDebtorAccount']);
        }
        if (isset($transferInformation['debtorCountry'])) {
            $transfer->setCountry($transferInformation['debtorCountry']);
        }
        if (isset($transferInformation['debtorAdrLine'])) {
            $transfer->setPostalAddress($transferInformation['debtorAdrLine']);
        }
        $this->payments[$paymentName]->addTransfer($transfer);

        return $transfer;
    }
}
