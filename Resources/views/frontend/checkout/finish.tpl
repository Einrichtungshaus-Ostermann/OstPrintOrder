
{* file to extend *}
{extends file="parent:frontend/checkout/finish.tpl"}

{* set our namespace *}
{namespace name="frontend/ost-print-order/checkout/finish"}





{block name='frontend_checkout_finish_teaser'}
    <div class="finish--teaser panel has--border is--rounded">




            <h2 class="panel--title teaser--title is--align-center">
                Vielen Dank für Ihre Bestellung!
            </h2>




        <div class="panel--body is--wide is--align-center">

            <p>
                Sie können die Bestellung nun an Ihrem PC ausdrucken.
            </p>


            <p class="teaser--actions">

                    <a href="#" class="ost-order-print--button btn is--primary teaser--btn-print" title="Drucken" data-order-number="{$sOrderNumber}">
                        Drucken
                    </a>
            </p>


        </div>


    </div>
{/block}







