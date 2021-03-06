{if $rows }
    <div class="crm-submit-buttons">
        <span class="element-right">{include file="CRM/common/formButtons.tpl" location="top"}</span>
    </div>
    <div class="spacer"></div>
    <br/>
    <div>
        {foreach from=$eventList item=event}
            <div><strong>{$event.title}</strong></div>
            <div>{$event.start|truncate:10:''|crmDate}</div>
            {if $event.participants}
                <table>
                    <tr>
                        <th width="33%">{ts}Contact ID{/ts}</th>
                        <th width="33%">{ts}Name{/ts}</th>
                        <th width="33%">{ts}Status{/ts}</th>
                    </tr>
                    {foreach from=$event.participants item=part}
                        <tr class="{cycle values="odd-row,even-row"}">
                            <td class="crm-event-print-participant_id">{$part.cid}</td>
                            <td class="crm-event-print-participant_name">{$part.name}</td>
                            <td class="crm-event-print-participant_status">{$part.role} / {$part.status}</td>
                        </tr>
                    {/foreach}
                </table>
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