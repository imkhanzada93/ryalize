# Feature Guide

## Namespace import

Respect\Validation is namespaced, but you can make your life easier by importing
a single class into your context:

```php
use Respect\Validation\Validator as v;
```

## Simple validation

The Hello World validator is something like this:

```php
$number = 123;
v::numeric()->validate($number); // true
```

## Chained validation

It is possible to use validators in a chain. Sample below validates a string
containing numbers and letters, no whitespace and length between 1 and 15.

```php
$usernameValidator = v::alnum()->noWhitespace()->length(1, 15);
$usernameValidator->validate('alganet'); // true
```

## Validating object attributes

Given this simple object:

```php
$user = new stdClass;
$user->name = 'Alexandre';
$user->birthdate = '1987-07-01';
```

Is possible to validate its attributes in a single chain:

```php
$userValidator = v::attribute('name', v::stringType()->length(1, 32))
                  ->attribute('birthdate', v::date()->age(18));

$userValidator->validate($user); // true
```

Validating array keys is also possible using `v::key()`

Location that we used `v::stringType()` and `v::date()` in the beginning of the validator.
Although is not mandatory, it is a good practice to use the type of the
validated object as the first node in the chain.

## Input optional

On oldest versions of Respect\Validation all validators treat input as optional
and accept an empty string input as valid. Even though a useful feature that
caused a lot of troubles for our team and neither was an obvious behavior. Also
there was some people who likes to accept `null` as optional value, not only an
empty string.

For that reason all rules are mandatory now but if you want to treat a value as
optional you can use `v::optional()` rule:

```php
v::alpha()->validate(''); // false input required
v::alpha()->validate(null); // false input required

v::optional(v::alpha())->validate(''); // true
v::optional(v::alpha())->validate(null); // true
```

By _optional_ we consider `null` or an empty string (`''`).

See more on [Optional](rules/Optional.md).

## Negating rules

You can use the `v::not()` to negate any rule:

```php
v::not(v::intVal())->validate(10); // false, input must not be integer
```

## Validator reuse

Once created, you can reuse your validator anywhere. Remember `$usernameValidator`?

```php
$usernameValidator->validate('respect');            //true
$usernameValidator->validate('alexandre gaigalas'); // false
$usernameValidator->validate('#$%');                //false
```

## Exception types

* `Respect\Validation\Exceptions\ExceptionInterface`:
    * All exceptions implement this interface;
* `Respect\Validation\Exceptions\ValidationException`:
    * Implements the `Respect\Validation\Exceptions\ExceptionInterface` interface
    * Thrown when the `check()` fails
    * All validation exceptions extend this class
    * Available methods:
        * `getMainMessage()`;
        * `setMode($mode)`;
        * `setName($name)`;
        * `setParam($name, $value)`;
        * `setTemplate($template)`;
        * more...
* `Respect\Validation\Exceptions\NestedValidationException`:
    * Extends the `Respect\Validation\Exceptions\ValidationException` class
    * Usually thrown when the `assert()` fails
    * Available methods:
        * `findMessages()`;
        * `getFullMessage()`;
        * `getMessages()`;
        * more...

## Informative exceptions

When something goes wrong, Validation can tell you exactly what's going on. For this,
we use the `assert()` method instead of `validate()`:

```php
use Respect\Validation\Exceptions\NestedValidationException;

try {
    $usernameValidator->assert('really messed up screen#name');
} catch(NestedValidationException $exception) {
   echo $exception->getFullMessage();
}
```

The printed message is exactly this, as a nested Markdown list:

```no-highlight
- All of the required rules must pass for "really messed up screen#name"
  - "really messed up screen#name" must contain only letters (a-z) and digits (0-9)
  - "really messed up screen#name" must not contain whitespace
  - "really messed up screen#name" must have a length between 1 and 15
```

## Getting all messages as an array

The Markdown list is fine, but unusable on a HTML form or something more custom.
For that you can use `getMessages()`.

It will return all messages from the rules that did not pass the validation.

```php
try {
    $usernameValidator->assert('really messed up screen#name');
} catch(NestedValidationException $exception) {
    print_r($exception->getMessages());
}
```

The code above may display something like:

```no-highlight
Array
(
    [0] => "really messed up screen#name" must contain only letters (a-z) and digits (0-9)
    [1] => "really messed up screen#name" must not contain whitespace
    [2] => "really messed up screen#name" must have a length between 1 and 15
)
```

## Getting messages as an array by name

If you want to get specific message by name you can use `findMessages()` passing
the names of the rules you want:

```php
try {
    $usernameValidator->assert('really messed up screen#name');
} catch(NestedValidationException $exception) {
    print_r($exception->findMessages(['alnum', 'noWhitespace']));
}
```

The `findMessages()` returns an array with messages from the requested validators,
like this:

```no-highlight
Array
(
    [alnum] => "really messed up screen#name" must contain only letters (a-z) and digits (0-9)
    [noWhitespace] => "really messed up screen#name" must not contain whitespace
)
```

## Custom messages

Getting messages as an array is fine, but sometimes you need to customize them in order
to present them to the user. This is possible using the `findMessages()` method as well:

```php
$errors = $exception->findMessages([
    'alnum' => '{{name}} must contain only letters and digits',
    'length' => '{{name}} must not have more than 15 chars',
    'noWhitespace' => '{{name}} cannot contain spaces'
]);
```

For all messages, the `{{name}}` variable is available for templates. If you
do not define a name it uses the input to replace this placeholder.

## Message localization

You're also able to translate your message to another language with Validation.
The only thing one must do is to define the param `translator` as a callable that
will handle the translation:

```php
$exception->setParam('translator', 'gettext');
```

The example above uses `gettext()` but you can use any other callable value, like
`[$translator, 'trans']` or `you_custom_function()`.

After that, if you call `getMainMessage()` or `getFullMessage()` (for nested),
the message will be translated.

Location that `getMessage()` will keep the original message.

## Custom rules

You also can use your own rules:

```php
namespace My\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class MyRule extends AbstractRule
{
    public function validate($input)
    {
        // Do something here with the $input and return a boolean value
    }
}
```

If you do want Validation to execute you rule (or rules) in the chain, you must
use `v::with()` passing your rule's namespace as an argument:

```php
v::with('My\\Validation\\Rules\\');
v::myRule(); // Try to load "My\Validation\Rules\MyRule" if any
```

By default `with()` appends the given prefix, but you can change this behavior
in order to overwrite default rules:

```php
v::with('My\\Validation\\Rules', true);
v::alnum(); // Try to use "My\Validation\Rules\Alnum" if any
```

If you're using the `assert()` or `check()` methods you also need to create an
Exception to declare the messages returned:

```php
namespace My\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class MyRuleException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must pass my rules',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not pass my rules',
        ]
    ];
}
```

Notice that while the namespace of the rule is `My\Validation\Rules` the
namespace of the exception is `My\Validation\Exceptions`.

## Validator name

On `v::attribute()` and `v::key()`, `{{name}}` is the attribute/key name. For others,
is the same as the input. You can customize a validator name using:

```php
v::date('Y-m-d')->between('1980-02-02', 'now')->setName('Member Since');
```

## Zend/Symfony validators

It is also possible to reuse validators from other frameworks if they are installed:

```php
$hostnameValidator = v::zend('Hostname')->assert('google.com');
$timeValidator     = v::sf('Time')->assert('22:00:01');
```

## Validation methods

We've seen `validate()` that returns true or false and `assert()` that throws a complete
validation report. There is also a `check()` method that returns an Exception
only with the first error found:

```php
use Respect\Validation\Exceptions\ValidationException;

try {
    $usernameValidator->check('really messed up screen#name');
} catch(ValidationException $exception) {
    echo $exception->getMainMessage();
}
```

Message:

```no-highlight
"really messed up screen#name" must contain only letters (a-z) and digits (0-9)
```
