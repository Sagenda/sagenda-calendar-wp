<?php

namespace SagendaCalendar\Models\Entities;

class BookableItem
{
  public $Id = "";
  public $Name = "";
  public $Location = "";
  public $Description = "";
  public $SelectedId = "";

  public function toJson()
  {
    return json_encode($this);
  }
}
