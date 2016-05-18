<?php

  /**
   * This file contains the a ProfitWell API class definition
   *
   * @package    ProfitWell API class
   * @subpackage Common
   * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
   * @author     Matthew Raymer <matthew.raymer@anomalistdesign.com>
   *
   *  example:  $pw = new ProfitWell("8537cd5a770c242b57b1833cceb86bf4");
   *
   */


  /**
   * A PHP class for accessing Profit
   *
   * The class is empty for the sake of this example.
   *
   * @package
   * @subpackage Common
   * @author     Matthew Raymer <matthew.raymer@anomalistdesign.com>
   */
  class ProfitWell {

    /*
     *  Private Properties
     */

    private $_api_key = "";
    private $_base_url = "https://www.profitwell.com/api/v1/";
    private $_command = "";
    private $_verb = "POST";
    private $_request = "";
    private $_response = "";
    private $_isDelete = false;
    private $_error = false;
    private $_message = "";
    private $_last_request = "";

    private $_user_id = "";
    private $_subscription_id = "";

    private $_email = "";
    private $_plan_name = "";
    private $_plan_interval = "";
    private $_plan_value = "";
    private $_currency = "";
    private $_start_date = "";
    private $_end_date = ""; // Optional

    /**
     * Class constructor for Profitwell API class
     *
     * @param string $key Profitwell API key
     */
    public function ProfitWell( $key ) {
      $this->_api_key = $key;
    }

    /*
     *  Property Getters and Setters
     */


    public function GetLastRequest() {
      return $this->_last_request;
    }

    /**
     * Retrieve the data from the response from ProfitWell
     *
     * @return string|data return from request to ProfitWell
     */
     public function GetResponse() {
       return $this->_response;
     }

    /**
     * Flag if there is an error
     *
     * @return boolean|was there an error
     */
    public function HadError() {
      return $this->_error;
    }

    /**
     * Error message
     *
     * @return string|a description of the error
     */
    public function Error() {
      return $this->_message;
    }

    /**
     * Set the ProfitWell user_id
     *
     * @param string|ProfitWell user_id
     */
    public function SetUserId( $id ) {
      $this->_user_id = $id;
    }

    /**
     * Retrieve the ProfitWell user_id
     *
     * @return string|ProfitWell user_id
     */
    public function GetUserId() {
      return $this->_user_id;
    }

    /**
     * Set the ProfitWell subscription_id
     *
     * @param string|ProfitWell subscription_id
     */
    public function SetSubscriptionId( $id ) {
      $this->_subscription_id = $id;
    }

    /**
     * Retrieve the ProfitWell subscription_id
     *
     * @return string|ProfitWell subscription_id
     */
    public function GetSubscriptionId() {
      return $this->_subscription_id;
    }

    /**
     * Set the ProfitWell email address
     * @param string|email address
     */
    public function SetEmail( $email ) {
      $this->_email = $email;
    }

    /**
     * Retrieve the ProfitWell email address
     *
     * @return string|ProfitWell email address
     */
    public function GetEmail() {
      return $this->_email;
    }

    /**
     * Set the ProfitWell plan name
     * @param string|plan name
     */
    public function SetPlanName( $name ) {
      $this->_plan_name = $name;
    }

    /**
     * Retrieve the ProfitWell plan name
     *
     * @return string|ProfitWell plan name
     */
    public function GetPlanName() {
      return $this->_plan_name;
    }

   /**
     * Retrieve the ProfitWell plan interval
     *
     * @param string|ProfitWell plan interval
     */
    public function SetPlanInterval( $plan_interval ) {
      $this->_plan_interval = $plan_interval;
    }

   /**
     * Retrieve the ProfitWell plan interval
     *
     * @return string|ProfitWell plan interval
     */
    public function GetPlanInterval() {
      return $this->_plan_interval;
    }

    /**
     * Retrieve the ProfitWell plan value
     *
     * @param string|ProfitWell plan value
     */
    public function SetPlanValue( $value ) {
      $this->_plan_value = round( floatval($value), 2 );
    }

    /**
     * Retrieve the ProfitWell plan value
     *
     * @return string|ProfitWell plan value
     */
    public function GetPlanValue() {
      return $this->_plan_value;
    }

    /**
     * Set the ProfitWell Currency
     *
     * @param string|ProfitWell Currency
     */
    public function SetCurrency( $currency ) {
      $this->_currency = $currency;
    }

    /**
     * Get the ProfitWell Currency
     *
     * @return string|ProfitWell Currency
     */
    public function GetCurrency() {
      return $this->_currency;
    }

    /**
     * Set the ProfitWell StartDate
     *
     * @param string|ProfitWell StartDate
     */
    public function SetStartDate( $date ) {
      $this->_start_date = $date;
    }

   /**
     * Get the ProfitWell StartDate
     *
     * @return string|ProfitWell StartDate
     */
    public function GetStartDate() {
      return $this->_start_date;
    }

   /**
     * Set the ProfitWell EndDate
     *
     * @param string|ProfitWell EndDate
     */
    public function SetEndDate( $end_date ) {
      $this->_end_date = $end_date;
    }

    /**
     * Get the ProfitWell EndDate
     *
     * @return string|ProfitWell EndDate
     */
    public function GetEndDate() {
      return $this->_end_date;
    }

    /*
     *  Public Methods
     */

    /**
     * Add a user subscription to ProfitWell
     *
     */
    public function Add() {
      $this->_verb = "POST";
      $this->_command = "transactions/";
      $this->request();
      if ( $this->_response == "" ) {
	$this->_error = true;
	$this->_message = "Expected return data from server for Add event.";
      } else {
	$ro = json_decode( $this->_response );
	$this->_user_id = $ro->user_id;
	$this->_subscription_id = $ro->subscription_id;
      }
    }

    public function Output() {
      echo "user_id: " . $this->_user_id . "\n";
      echo "subscription_id: " . $this->_subscription_id . "\n";
      echo "email: " . $this->_email . "\n";
      echo "plan_name: " . $this->_plan_name . "\n";
      echo "plan_interval: " . $this->_plan_interval . "\n";
      echo "plan_value: " . $this->_plan_value . "\n";
      echo "currency: " . $this->_currency . "\n";
      echo "start_date: " . $this->_start_date . "\n";
      echo "end_date: " . $this->_end_date . "\n";
    }

    public function toString() {
      $result  = "user_id: " . $this->_user_id . "\n";
      $result .= "subscription_id: " . $this->_subscription_id . "\n";
      $result .="email: " . $this->_email . "\n";
      $result .="plan_name: " . $this->_plan_name . "\n";
      $result .="plan_interval: " . $this->_plan_interval . "\n";
      $result .="plan_value: " . $this->_plan_value . "\n";
      $result .="currency: " . $this->_currency . "\n";
      $result .="start_date: " . $this->_start_date . "\n";
      $result .="end_date: " . $this->_end_date . "\n";
      return $result;
    }

    public function toHtml() {
      $result  = "<ul>";
      $result  = "<li>user_id: " . $this->_user_id . "</li>";
      $result .= "<li>subscription_id: " . $this->_subscription_id . "</li>";
      $result .= "<li>email: " . $this->_email . "</li>";
      $result .= "<li>plan_name: " . $this->_plan_name . "</li>";
      $result .= "<li>plan_interval: " . $this->_plan_interval . "</li>";
      $result .= "<li>plan_value: " . $this->_plan_value . "</li>";
      $result .= "<li>currency: " . $this->_currency . "</li>";
      $result .= "<li>start_date: " . $this->_start_date . "</li>";
      $result .= "end_date: " . $this->_end_date . "</li>";
      $result .= "</ul>";
      return $result;
    }

    public function toJSON() {
      $result = array(
		"user_id" => $this->_user_id,
	"subscription_id" => $this->_subscription_id,
		  "email" => $this->_email,
	      "plan_name" => $this->_plan_name,
	     "plan_value" => $this->_plan_value,
	       "currency" => $this->_currency,
	     "start_date" => $this->_start_date,
	       "end_date" => $this->_end_date);
      return json_encode( $result );
    }

    /**
     * Update a user subscription to ProfitWell
     *
     */
    public function Update( $user_id ) {
      $this->_verb="POST";
      $this->_start_date = date("Y-m-d\TH:i");
      if ( $user_id == "" ) {
	$this->_error = true;
	$this->_message = "Update requires a ProfitWell user_id to be populated";
      } else {
	  $this->_user_id = $user_id;
	$this->_command = "transactions/" . $user_id ."/";
	$this->request();
      }
    }

    /**
     * Churn a user subscription to ProfitWell
     *
     * Churning is ending a subscription
     * @param string|ProfitWell user_id
     */
    public function Churn( $user_id ) {
      $this->_verb = "POST";
      $this->_command = "transactions/" . $user_id . "/";
      $this->_plan_value = 0;
      $this->_start_date = date("Y-m-d\TH:i");
      $this->request();
    }

    /**
     * RemoveChurn Update the user_id to ProfitWell
     *
     * Reinstate the Subscriptions to user_id
     * @param string|ProfitWell user_id
     */
    public function RemoveChurn( $user_id ) {
      $this->_verb = "POST";
      $this->_command = "transactions/" . $this->_user_id . "/";
      $this->request();
    }

    /**
     * Deleting all the data of the user from ProfitWell
     *
     * @param string|ProfitWell user_id
     */
    public function Delete( $user_id ) {
      $this->_verb="DELETE";
      $this->_command = "transactions/user/" . $user_id . "/";
      $this->request();
    }

    /**
     * Listing all the data of all the  users to  ProfitWell
     *
     * @return string|an array of ProfitWell user subscriptions
     */
    public function ListAll() {
      $this->_verb = "GET";
      $this->_command = "transactions/";
      $this->request();
      return $this->_response;
    }

   /**
     * Listing of a data  for the  user for a specific user_id to ProfitWell
     *
     * @param string|ProfitWell user_id
     * @return string|array of data about a single ProfitWell subscription
     */
    public function ListByUserId( $user_id ) {
      $this->_verb = "GET";
      $this->_command = "transactions/user/" . $user_id . "/";
      $this->request();
      return $this->_response;
    }

   /**
     * Creating a JSON data pocket request  for Profitwell
     *
     */
    private function MakeRequest() {
      $end_date = trim($this->_end_date) == "" ? "null" : "\"$this->_end_date\"";
      $s_end_date = trim($this->_end_date) == "" ? "" :	",\"end_date\": $end_date";
      $this->_request = "{
      \"email\": \"$this->_email\",
      \"plan_name\": \"$this->_plan_name\",
      \"plan_interval\": \"$this->_plan_interval\",
      \"plan_value\": $this->_plan_value,
      \"currency\": \"$this->_currency\",
      \"start_date\": \"$this->_start_date\"$s_end_date
      }";
      $this->_last_request = $this->_request;
    }

    private function isValid() {
      $valid = true;
      if ( trim($this->_email) == "" ) $valid = false;
      if ( trim($this->_plan_name) == "") $valid = false;
      if ( trim($this->_plan_interval) == "") $valid = false;
      if ( trim($this->_currency) == "") $valid = false;
      if ( trim($this->_start_date) == "") $valid = false;
      return $valid;
    }

    /**
     * Send data to ProfitWell and handle the return response data
     *
     */
    private function request() {

      $this->MakeRequest();

      $ch = curl_init();
      $url = $this->_base_url . $this->_command;

      curl_setopt( $ch, CURLOPT_URL, $url );
      if ( $this->_verb == "DELETE" ) curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "DELETE" );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
      curl_setopt( $ch, CURLOPT_HEADER, FALSE );
      if ( $this->_verb == "POST" ) {
	curl_setopt( $ch, CURLOPT_POST, TRUE );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $this->_request );
      }
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
	"Content-Type: application/json",
	"Authorization: " . $this->_api_key
      ));
      $response = curl_exec( $ch );
      curl_close( $ch );
      $this->_response = $response;

    }
  }

?>