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

{{if $properties}}
{{foreach $properties as $name => $property}}
{{if $annotation[$name]}}
    {{$annotation[$name]}}
{{/if}}
    {{$property}}

{{/foreach}}
{{/if}}

{{if $methods}}
{{foreach $methods as $key => $method}}
{{if $annotation[$key]}}
    {{$annotation[$key]}}
{{/if}}
    {{$method}}

{{/foreach}}
{{/if}}
}
