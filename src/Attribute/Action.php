<?php

namespace CEKW\WpPlugin\Attribute;

use Attribute;

/**
 * Attribute class as a wrapper around `add_action`.
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Action extends Filter
{
}