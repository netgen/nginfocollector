<form name="objects" method="post" action={concat( '/nginfocollector/extracollectionlist/', $collection.contentobject_id )|ezurl}>

    {* DESIGN: Header START *}
    <div class="box-header">
        <h1 class="context-title">
            {'Collection #%collection_id for <%object_name>'|i18n( 'design/admin/infocollector/view',, hash( '%collection_id', $collection.id, '%object_name', $collection.object.name ) )|wash}
            <span class="small-info">{'Last modified'|i18n( 'design/admin/infocollector/view' )}: {$collection.created|l10n( shortdatetime )}, {if $collection.creator} {$collection.creator.contentobject.name|wash} {else} {'Unknown user'|i18n( 'design/admin/infocollector/view' )} {/if}</span>
        </h1>
        {* DESIGN: Mainline *}
        <div class="header-mainline"></div>
    {* DESIGN: Header END *}
    </div>

    {* DESIGN: Content START *}
    <div class="panel">
        <div class="context-attributes infocollector-attributes">
            {section var=CollectedAttributes loop=$collection.attributes}
                <div class="block">
                    <input type="checkbox" name="FieldIDArray[]" value="{$CollectedAttributes.item.contentobject_attribute_id}">
                    <label>{$CollectedAttributes.item.contentclass_attribute_name|wash}:</label>
                    <span class="attribute">{attribute_result_gui view=info attribute=$CollectedAttributes.item}</span>
                </div>
                <hr>
            {/section}
        </div>

        {* DESIGN: Content END *}

        {* Buttons. *}
        <div class="controlbar">
        {* DESIGN: Control bar START *}
            <input class="btn btn-primary" type="submit" name="RemoveCollectionsButton" value="{'Remove'|i18n( 'design/admin/infocollector/view' )}" title="{'Remove collection.'|i18n( 'design/admin/infocollector/view' )}" />
            <input class="btn btn-primary" type="submit" name="AnonymizeCollectionsButton" value="{'Anonymize'|i18n( 'design/admin/infocollector/view' )}" title="{'Remove collection.'|i18n( 'design/admin/infocollector/view' )}" />
            <hr>
            <input class="btn btn-primary" type="submit" name="RemoveFieldsButton" value="{'Remove selected fields'|i18n( 'design/admin/infocollector/view' )}" title="{'Remove collection.'|i18n( 'design/admin/infocollector/view' )}" />
            <input class="btn btn-primary" type="submit" name="AnonymizeFieldsButton" value="{'Anonymize selected fields'|i18n( 'design/admin/infocollector/view' )}" title="{'Remove collection.'|i18n( 'design/admin/infocollector/view' )}" />
            <input type="hidden" name="CollectionIDArray[]" value="{$collection.id}" />
            <input type="hidden" name="Handling" value="single" />
        </div>
        {* DESIGN: Control bar END *}

    </div>
</form>
