sepa-swift-xml
============

Master: [![Build Status](https://travis-ci.com/pepperbay/php-swift-sepa-xml.svg?branch=master)](http://travis-ci.org/pepperbay/php-swift-sepa-xml)

SEPA and SWIFT file generator for PHP.

Creates XML files for the Single Euro Payments Area (SEPA) or SWIFT Credit Transfer and Direct Debit Payments Initiation messages. These SEPA XML messages are a subset of the "ISO20022 Universal financial industry message scheme".

License: GNU Lesser General Public License v3.0


The versions of the standard followed are:
* _pain.001.002.03_ (or _pain.001.001.03_) for credit transfers
* and _pain.008.002.02_ (or _pain.008.001.02_) for direct debits (currently only SEPA)

Institutions and associations that should accept this format:
* Deutsche Kreditwirtschaft
* Fédération bancaire française
* ING (tested on direct credit, use _pain.001.001.03_)
* Societé Générale (tested on direct credit, use _pain.001.001.03_)
* Spain: CaixaBank
* Spain: SantanderBank

Always verify generated files with your bank before using in production! If you encounter an institution that does accept this library's generated files please notify us to add it to the list or send a PR!


## Installation

### Composer

This library is available in packagist.org, you can add it to your project
via Composer.

In the "require" section of your composer.json file:

Always up to date (bleeding edge, API *not* guaranteed stable)
```javascript
"pepperbay/php-swift-sepa-xml" : "dev-master"
```

Specific version, API stability
```javascript
"pepperbay/php-swift-sepa-xml" : "2.0.*"
```
## Documentation

* [handling Direct Debits](doc/direct_debit.md)
* [handling Credit Transfers](doc/direct_credit.md)

## External Resources

* [Official ISO20022 Website](https://www.iso20022.org/)
* [ISO20022 Message Catalog](https://www.iso20022.org/full_catalogue.page)
* [ISO 20022 in XMLdation's wiki](https://wiki.xmldation.com/General_Information/ISO_20022)
* [InstdAmt vs. EqvtAmt](https://wiki.xmldation.com/General_Information/ISO_20022/Difference_between_InstdAmt_and_EqvtAmt)
* [CreditorIdentifier explanation](http://www.sepaforcorporates.com/sepa-direct-debits/sepa-creditor-identifier/)
* [SEPA Externded Character Set reference](http://www.sepahungary.hu/uploads/files/EPC217-08%20Best%20Practices%20-SEPA%20Requirements%20for%20Character%20Set.pdf)
* [ECB SEPA gateway page](http://www.ecb.europa.eu/paym/retpaym/html/index.en.html)
* [SEPA for Corporates Blog](http://www.sepaforcorporates.com/)

##Special Credits

This package is based on the package [php-sepa-xml](https://github.com/php-sepa-xml/php-sepa-xml)
