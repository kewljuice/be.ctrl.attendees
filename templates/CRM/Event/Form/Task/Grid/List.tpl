{if $rows }
    <div class="crm-submit-buttons">
        <span class="element-right">{include file="CRM/common/formButtons.tpl" location="top"}</span>
    </div>
    <div class="spacer"></div>
    <br/>
    <div>
        {foreach from=$eventList item=event}
            <div style="text-align: center; margin-bottom: 25px">
                <div><strong>{$event.title}</strong></div>
                <div>{$event.start|date_format:"%d/%m/%Y"}</div>
            </div>
            {if $event.participants}
                {html_table loop=$event.participants cols=2 td_attr='style="padding:15px;width:50%"'}
            {/if}
        {/foreach}
    </div>
    <div class="form-item">
        <span class="element-right">{include file="CRM/common/formButtons.tpl"}</span>
    </div>
{else}
    <div class="messages status no-popup">
        <div class="icon inform-icon"></div>
        &nbsp;{ts}There are no records selected for Print.{/ts}
    </div>
{/if}