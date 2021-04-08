<?php
declare(strict_types=1);

namespace Foo;

define('WATCHDOG_ERROR', 3);


function _() : void
{
  # magic
}

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

