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

