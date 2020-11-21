<?php

namespace Tracking;

use FastSimpleHTMLDom\Document;

class BgPostService
{
    protected $bgPostUrl = "http://www.bgpost.bg/IPSWebTracking/IPSWeb_item_events.asp?itemid=";
    /** @var  Document */
    protected $dom;

    const DATE_LABEL = "Local Date and Time";
    const COUNTRY_LABEL = "Country";
    const LOCATION_LABEL = "Location";
    const EVENT_LABEL = "Event Type";
    const INFO_LABEL = "Extra Information";

    const DATE_JSON_LABEL = "date";
    const COUNTRY_JSON_LABEL = "country";
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
        $this->dom = Document::file_get_html($this->bgPostUrl . $trackingNumber);

        $tableBody = $this->dom->find('td.tabproperty')->find("tbody", 0);
        $tableData = [];

        if ($tableBody != null) {
            $trs = $tableBody->find("tr")->getArrayCopy();

            $postInfo = array_shift($trs);
            $headers = array_shift($trs)->find("td")->getArrayCopy();

            foreach ($trs as $tr) {
                $trData = [];
                $tds = $tr->find("td");
                foreach ($tds as $key => $td) {
                    if (!array_key_exists($key, $headers)) {
                        continue;
                    }
                    $trData[$this->getIndexName(trim($headers[$key]->plaintext))] = trim($td->plaintext);
                }

                $trData[self::STATUS_JSON_LABEL] = $this->getStatus($trData[self::EVENT_JSON_LABEL]);

                $tableData[] = $trData;
            }
        }

        return $tableData;
    }

    public function getIndexName(string $tableLabel): string
    {
        $labelIndex = "";
        switch ($tableLabel) {
            case self::DATE_LABEL:
                $labelIndex = self::DATE_JSON_LABEL;
                break;
            case self::COUNTRY_LABEL:
                $labelIndex = self::COUNTRY_JSON_LABEL;
                break;
            case self::LOCATION_LABEL:
                $labelIndex = self::LOCATION_JSON_LABEL;
                break;
            case self::EVENT_LABEL:
                $labelIndex = self::EVENT_JSON_LABEL;
                break;
            case self::INFO_LABEL:
                $labelIndex = self::INFO_JSON_LABEL;
                break;
        }

        return $labelIndex;
    }

    public function getStatus(string $eventType): string
    {
        $status = self::EVENT_STATUS_TRAVELING;

        if (trim($eventType) == "Пратката  e получена") {
            $status = self::EVENT_STATUS_ARRIVED;
        }

        if (trim($eventType) == "Грешен код на пратката") {
            $status = self::EVENT_STATUS_WRONG_CODE;
        }

        if (strpos(trim($eventType), "Пратката не подлежи на проследяване") !== false) {
            $status = self::EVENT_STATUS_NO_DATA;
        }

        return $status;
    }
}
