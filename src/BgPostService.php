<?php

namespace Tracking;

use FastSimpleHTMLDom\Document;

class BgPostService
{
    protected $bgPostUrl = "https://www.bgpost.bg/api/trace/parcel/";

    const DATE_LABEL = "date_reg";
    const LOCATION_LABEL = "office_name";
    const EVENT_LABEL = "event_name";
    const STATUS_LABEL = "status_name";
    const INFO_LABEL = "note";

    const DATE_JSON_LABEL = "date";
    const LOCATION_JSON_LABEL = "location";
    const EVENT_JSON_LABEL = "event";
    const STATUS_JSON_LABEL = "status";
    const INFO_JSON_LABEL = "info";

    const EVENT_STATUS_TRAVELING = "traveling";
    const EVENT_STATUS_ARRIVED = "arrived";
    const EVENT_STATUS_WRONG_CODE = "wrong_code";
    const EVENT_STATUS_NO_DATA = "no_data";

    public function __construct()
    {
    }

    /**
     * @param string $trackingNumber
     * @return array
     */
    public function track(string $trackingNumber): array
    {

        $tableData = [];
        if (
            preg_match('/^[L|l|R|r|C||c|E|e|V|v]{1}[a-zA-Z]{1}\d{9}[a-zA-Z]{2}$/', $trackingNumber) ||
            preg_match('/^[P|p]{1}[S|s]{1}.{11}$$/', $trackingNumber)
        ) {
            $json = json_decode((file_get_contents($this->bgPostUrl . $trackingNumber)), true);
            if ($json != null && is_array($json) && isset($json["parcels"]) && is_array($json["parcels"]) && count($json["parcels"]) > 0) {
                foreach ($json["parcels"] as $trace) {
                    $trData = [];
                    $trData[self::DATE_JSON_LABEL] = $trace[self::DATE_LABEL];
                    $trData[self::LOCATION_JSON_LABEL] = $trace[self::LOCATION_LABEL];
                    $trData[self::EVENT_JSON_LABEL] = $trace[self::EVENT_LABEL];
                    $trData[self::STATUS_JSON_LABEL] = $trace[self::STATUS_LABEL];
                    $trData[self::INFO_JSON_LABEL] = $trace[self::INFO_LABEL];

                    $tableData[] = $trData;
                }
            } else {
                $tableData[] = $this->getDummyData(self::EVENT_STATUS_NO_DATA);
            }
        } else {
            $tableData[] = $this->getDummyData(self::EVENT_STATUS_WRONG_CODE);
        }
        return $tableData;
    }

    public function getDummyData(string $status): array
    {
        $dummyEvent[self::DATE_JSON_LABEL] = "";
        $dummyEvent[self::LOCATION_JSON_LABEL] = "";
        $dummyEvent[self::EVENT_JSON_LABEL] = "";
        $dummyEvent[self::INFO_JSON_LABEL] = "";
        $dummyEvent[self::STATUS_JSON_LABEL] = $status;
        return $dummyEvent;
    }
}
