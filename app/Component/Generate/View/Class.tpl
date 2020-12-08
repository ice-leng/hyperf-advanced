<?php

declare(strict_types=1);

{{if $namespace }}namespace {{$namespace}}{{/if}}

{{if $uses }}
{{foreach $uses as $use}}
use {{$use}}
{{/foreach}}
{{/if}}

class {{$classname}} {{if $inheritance }}extends {{$inheritance}}{{/if}} {{if $implements }}implements {{foreach $implements as $implement }}{{$implement}}, {{/foreach}} {{/if}}
{

}
