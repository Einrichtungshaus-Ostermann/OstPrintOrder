
{* file to extend *}
{extends file="parent:frontend/index/index.tpl"}

{* set our namespace *}
{namespace name="frontend/ost-print-order/index/index"}






{* append our javascript *}
{block name='frontend_index_header_javascript_jquery'}


        {* our plugin configuration *}
        <script type="text/javascript">

            {* javascript variables *}
            var ostPrintOrderConfiguration = {



                checkPrinterUrl:       '{url controller="OstPrintOrder" action="checkPrinter"}',
                printOrderUrl:       '{url controller="OstPrintOrder" action="printOrder"}'
            };

        </script>



    {* smarty parent *}
    {$smarty.block.parent}

{/block}



