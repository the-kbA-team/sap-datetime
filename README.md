# SAP DateTime

[![License: MIT][license-mit]](LICENSE)
[![Build Status][build-status-master]][travis-ci]
[![Maintainability][maintainability-badge]][maintainability]
[![Test Coverage][coverage-badge]][coverage]

Extends PHP's DateTime class by SAP week, date and timestamp format.

* SAP week in format `<year><week>`
* SAP date in format `<year><month><day>`
* SAP timestamp in format `<year><month><day><hour><minute><second>`

## Usage

```
composer require kba-team/sap-datetime:~1.0.0
```

```php
<?php
use kbATeam\SapDateTime\SapDateTime;
$dateTime = SapDateTime::createFromFormat(SapDateTime::SAP_WEEK, '201846');
echo $dateTime->format('o \w\e\ek W') . PHP_EOL;
/**
 * Output: 2018 week 46
 */
```

[license-mit]: https://img.shields.io/badge/license-MIT-blue.svg
[travis-ci]: https://travis-ci.org/the-kbA-team/sap-datetime
[build-status-master]: https://api.travis-ci.org/the-kbA-team/sap-datetime.svg?branch=master
[maintainability-badge]: https://api.codeclimate.com/v1/badges/324a7105eb2e0a215f33/maintainability
[maintainability]: https://codeclimate.com/github/the-kbA-team/sap-datetime/maintainability
[coverage-badge]: https://api.codeclimate.com/v1/badges/324a7105eb2e0a215f33/test_coverage
[coverage]: https://codeclimate.com/github/the-kbA-team/sap-datetime/test_coverage
