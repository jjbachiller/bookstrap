<?php

namespace App\Exceptions;

use Exception;

class NoSpaceLeftException extends Exception
{
  private $sectionId;

  public function __construct($sectionId)
  {
    $this->sectionId = $sectionId;

    parent::__construct(config('bookstrap-constants.DENIES.NOT_ENOUGH_SPACE.message'), config('bookstrap-constants.DENIES.NOT_ENOUGH_SPACE.code'));
  }
}
