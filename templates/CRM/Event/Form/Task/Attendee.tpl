<p>

{if $rows }
<div class="crm-submit-buttons">
     <span class="element-right">{include file="CRM/common/formButtons.tpl" location="top"}</span>
</div>
<div class="spacer"></div>
<br />
<p>
    <!-- php -->
    {php}
        // Get all results.
        $results = $this->_tpl_vars[rows];
        // print '<pre>'. print_r($results, true) .'</pre>';

        // Get & loop all event ids.
        $events = array_unique(array_column($results, 'event_id'));
        foreach($events as $eid){

            // Fetch vars for event information
            $event = array_search($eid, array_column($results, 'event_id'));
            $title = $results[$event][event_title];
            $start = $results[$event][event_start_date];

            // Print event information.
            print "<h2>($eid) $title</h2>";
            print "<div style='font-style: italic'>$start</div>";

            // Get & loop participants by event id.
            $participants = array_keys(array_column($results, 'event_id'), $eid);
            foreach($participants as $pid){
                $cid = $results[$pid][contact_id];
                $name = $results[$pid][sort_name];
                // Print participant information.
                print "<li>($cid) $name</li>";
            }
        }
    {/php}
<table>
  <tr class="columnheader">
    <th>{ts}Name{/ts}</th>
    <th>{ts}Event{/ts}</th>
    <th>{ts}Fee Level{/ts}</th>
    <th>{ts}Fee Amount{/ts}</th>
    <th>{ts}Event Date{/ts}</th>
    <th>{ts}Status{/ts}</th>
    <th>{ts}Role{/ts}</th>
  </tr>
{foreach from=$rows item=row}
    <tr class="{cycle values="odd-row,even-row"}">
        <td class="crm-event-print-sort_name">{$row.sort_name}</td>
        <td class="crm-event-print-event_title">{$row.event_title}</td>
        {assign var="participant_id" value=$row.participant_id}
        {if $lineItems.$participant_id}
            <td>
            {foreach from=$lineItems.$participant_id item=line name=lineItemsIter}
               {$line.label}: {$line.qty}
               {if ! $smarty.foreach.lineItemsIter.last}<br>{/if}
            {/foreach}
            </td>
        {else}
            <td>{if !$row.paid && !$row.participant_fee_level} {ts}(no fee){/ts}{else} {$row.participant_fee_level}{/if}</td>
        {/if}
        <td class="crm-event-print-event_participant_fee_amount">{$row.participant_fee_amount|crmMoney}</td>
        <td class="crm-event-print-event_date">{$row.event_start_date|truncate:10:''|crmDate}
          {if $row.event_end_date && $row.event_end_date|date_format:"%Y%m%d" NEQ $row.event_start_date|date_format:"%Y%m%d"}
              <br/>- {$row.event_end_date|truncate:10:''|crmDate}
          {/if}
        </td>
        <td class="crm-event-print-participant_status">{$row.participant_status}</td>
        <td class="crm-event-print-participant_role_id">{$row.participant_role_id}</td>
    </tr>
{/foreach}
</table>

<div class="form-item">
     <span class="element-right">{include file="CRM/common/formButtons.tpl"}</span>
</div>

{else}
<div class="messages status no-popup">
    <div class="icon inform-icon"></div>&nbsp;{ts}There are no records selected for Print.{/ts}
</div>
{/if}
