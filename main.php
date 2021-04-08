<?php
declare(strict_types=1);

# This does seem to need to be in a separate file to cause the problem.
require __DIR__ . '/Foo/base.php';


function goomba ()
{
  # Calling a function that only calls a function with the name "_" causes this
  # erroneous inspection error.
  \Foo\causesInspectionError();

  # This function makes calls to more than just the "_" function and that fixes
  # the erroneous inspection.
  \Foo\noInspectionError();

  # Call the "_" function by itself is fine.
  \Foo\_();
}
