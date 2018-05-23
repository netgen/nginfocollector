{* DESIGN: Header START *}
<div class="box-header">
    <h1 class="context-title">{'Confirm information collection anonymization'|i18n( 'design/admin/infocollector/confirmremoval' )}</h1>

    {* DESIGN: Mainline *}
    <div class="header-mainline"></div>

{* DESIGN: Header END *}
</div>

{* DESIGN: Content START *}
<div class="panel">
    <div class="alert alert-warning">
        <h2>{'Are you sure you want to anonymize the collected information?'|i18n( 'design/admin/infocollector/confirmremoval' )}</h2>

        {if $collections|lt( 2 )}
            <p>{'%collections collection will be anonymized.'|i18n( 'design/admin/infocollector/confirmremoval',, hash( '%collections', $collections ) )}</p>
        {else}
            <p>{'%collections collections will be anonymized.'|i18n( 'design/admin/infocollector/confirmremoval',, hash( '%collections', $collections ) )}</p>
        {/if}
    </div>
    <div class="controlbar">

        {* DESIGN: Control bar START *}
        <form action={concat( $module.functions.extracollectionlist.uri, '/', $object_id )|ezurl} method="post" name="ConfirmAnonymization">
            <input class="button" type="submit" name="ConfirmAnonymizationButton" value="{'OK'|i18n( 'design/admin/infocollector/confirmremoval' )}" />
            <input class="button" type="submit" name="CancelAnonymizationButton" value="{'Cancel'|i18n( 'design/admin/infocollector/confirmremoval' )}" />
        </form>

    </div>

    {* DESIGN: Control bar END *}

</div>
