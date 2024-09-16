<?php

namespace App;

enum TimeLogFormType: string
{
    case DEFAULT = 'default';
    case PROJECT = 'project';
    case USER = 'user';
}
