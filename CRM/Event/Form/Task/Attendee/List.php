<?php

/**
 * This class provides the functionality to participant records
 */
class CRM_Event_Form_Task_Attendee_List extends CRM_Event_Form_Task {

  /**
   * Build all the data structures needed to build the form.
   *
   * @return void
   */
  public function preProcess() {
    parent::preprocess();
    // set print view, so that print templates are called
    $this->controller->setPrint(1);
    // get the formatted params
    $queryParams = $this->get('queryParams');
    $sortID = NULL;
    if ($this->get(CRM_Utils_Sort::SORT_ID)) {
      $sortID = CRM_Utils_Sort::sortIDValue($this->get(CRM_Utils_Sort::SORT_ID),
        $this->get(CRM_Utils_Sort::SORT_DIRECTION)
      );
    }
    // Display name and participation details of participants.
    $participantIDs = implode(',', $this->_participantIds);
    $this->assign('Participants', $participantIDs);
    $selector = new CRM_Event_Selector_Search($queryParams, $this->_action, $this->_componentClause);
    $controller = new CRM_Core_Selector_Controller($selector, NULL, $sortID, CRM_Core_Action::VIEW, $this, CRM_Core_Selector_Controller::SCREEN);
    $controller->setEmbedded(TRUE);
    $controller->run();
  }

  /**
   * Build the form object - it consists of
   *    - displaying the QILL (query in local language)
   *    - displaying elements for saving the search
   *
   *
   * @return void
   */
  public function buildQuickForm() {
    //
    // Just need to add javascript to popup the window for printing.
    //
    $this->addButtons([
        [
          'type' => 'next',
          'name' => ts('Print'),
          'js' => ['onclick' => 'window.print()'],
          'isDefault' => TRUE,
        ],
        [
          'type' => 'back',
          'name' => ts('Done'),
        ],
      ]
    );
    //
    // Get rows from smarty template and alter/reorder them.
    //
    $smartyObject = $this->get_template_vars();
    $results = $smartyObject['rows'];
    $eventList = [];
    // Get & loop all events.
    $events = array_unique(array_column($results, 'event_id'));
    foreach ($events as $eid) {
      // Fetch vars for event information.
      $event = array_search($eid, array_column($results, 'event_id'));
      $title = $results[$event]['event_title'];
      $start = $results[$event]['event_start_date'];
      // Get & loop participants by event id.
      $participantList = [];
      $participants = array_keys(array_column($results, 'event_id'), $eid);
      foreach ($participants as $pid) {
        $cid = $results[$pid]['contact_id'];
        $name = $results[$pid]['sort_name'];
        $status = $results[$pid]['participant_status'];
        $role = $results[$pid]['participant_role_id'];
        $participantList[] = [
          'cid' => $cid,
          'name' => $name,
          'status' => $status,
          'role' => $role,
        ];
      }
      // Add variables to event container.
      $eventList[] = [
        'eid' => $eid,
        'title' => $title,
        'start' => $start,
        'participants' => $participantList,
      ];
    }
    // Assign new list to smarty as 'eventList'.
    $this->assign('eventList', $eventList);
  }

  /**
   * Process the form after the input has been submitted and validated.
   *
   *
   * @return void
   */
  public function postProcess() {
    // redirect to the main search page after printing is over
  }

}
