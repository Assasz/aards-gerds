# Aards Gerds

[![Build Status](https://scrutinizer-ci.com/g/Assasz/aards-gerds/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Assasz/aards-gerds/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/Assasz/aards-gerds/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Assasz/aards-gerds/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Assasz/aards-gerds/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Assasz/aards-gerds/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/Assasz/aards-gerds/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

RPG game running on Symfony Console. Fully powered by PHP.

### Installation

Via Composer:
```
composer create-project assasz/aards-gerds
```

### Development

(Docker-compose required, make nice to have)

First run:
```
make up
make composer-install
```

Code validation and tests:
```
make phpstan
make tests
```

Starting new game:
```
make new-game
```

Loading existing game:
```
make load-game p=Player
```
