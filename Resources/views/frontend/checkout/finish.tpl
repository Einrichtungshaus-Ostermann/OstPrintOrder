
{* file to extend *}
{extends file="parent:frontend/checkout/finish.tpl"}

{* set our namespace *}
{namespace name="frontend/ost-print-order/checkout/finish"}



{* set default message and printer button *}
{block name='frontend_checkout_finish_teaser'}

    <div class="finish--teaser panel has--border is--rounded">

        <h2 class="panel--title teaser--title is--align-center">
            {s name="teaser-title"}Glückwunsch, der Auftrag wurde erfolgreich abgeschlossen!{/s}
        </h2>

        <div class="panel--body is--wide is--align-center">
            <p>
                {s name="teaser-message"}Der Auftrag kann jetzt ausgedruckt werden.{/s}
            </p>
            <p class="teaser--actions">
                <a href="#" class="ost-order-print--button btn is--primary teaser--btn-print" title="Drucken" data-order-number="{$sOrderNumber}">
                    {s name="print-button"}Drucken{/s}
                </a>
            </p>
        </div>

    </div>

{/block}
