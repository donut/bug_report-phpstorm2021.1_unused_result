# bug_report-phpstorm2021.1_unused_result

Issue at JetBrains: https://youtrack.jetbrains.com/issue/WI-59716

---

Demonstration of what looks like a bug in PhpStorm 2021.1

Repo that reproduces this issue: https://github.com/donut/bug_report-phpstorm2021.1_unused_result

Basically, if you call `foo()` which itself only calls a function named `_()`, then `foo()` will be flagged with the inspection error "Expression result is not used anywhere" even though it returns nothing.

If I have Foo.php with:

```php
<?php
namespace Foo;

function _() : void {}

function causesInspectionError()
{
  _();
}

function other() {}

function noInspectionError()
{
  _();
  other(); # This can come before or after the `_()` call to fix the issue.
}
```

And then in main.php you have:

```php
<?php
# This does seem to need to be in a separate file to cause the problem.
require __DIR__ . '/Foo.php';

function goomba ()
{
  # Calling a function that only calls a function with the name "_" causes this
  # erroneous inspection error.
  \Foo\causesInspectionError();

  # This function makes calls to more than just the "_" function and that fixes
  # the erroneous inspection.
  \Foo\noInspectionError();

  # Call the "_" function directly is fine.
  \Foo\_();
}
```

Then the first call causes the erroneous inspection warning but the two following calls do not.

![](Screen Shot 2021-04-08 at 1046.23.png)

PS-211.6693.120, JRE 11.0.10+9-b1341.35x64 JetBrains s.r.o., OS Mac OS X(x86_64) v11.2.3, screens 5120.0x2880.0, 5120.0x2880.0, 3360.0x2100.0; Retina
