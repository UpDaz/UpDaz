<?php

namespace App\Enums;

/**
 * Lifecycle of a weekly topic proposed on Discord (see WeeklyDigest).
 */
enum TopicStatus: string
{
    case Proposed = 'proposed';
    case Interviewing = 'interviewing';
    case Drafting = 'drafting';
    case Drafted = 'drafted';
    case Expired = 'expired';
}
