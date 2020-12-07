<?php

declare(strict_types=1);

namespace {{$namespace}}

{{if $uses }}
{{foreach $uses as $use}}
use {{$use}}
{{/foreach}}
{{/if}}

class {{$classname}} {{if $inheritance }}extends {{$inheritance}}{{/if}} {{if $implement }}implements {{$implement}} {{/if}}
{
{{if $functions}}
{{foreach $functions as $name => $fun}}
    {{if $annotation[$name]}}
    {{$annotation[$name]}}
    {{/if}}
    {{$fun}}
{{/foreach}}
{{/if}}
}
