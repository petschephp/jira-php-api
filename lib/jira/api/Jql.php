<?php
namespace Jira\Api;

class Jql
{
    public $jqlParams = [];

    public function selectProject($projectKey = 'MYL')
    {
        $jqlQuery = $this->jqlParams['project'] = '=' . $projectKey;
        //  http: //162.254.144.149:8080/rest/api/2/search?jql=project=MYL&startAt=0&maxResults=1
        return $this;
    }

    public function limit($startAt, $maxResults)
    {
        $this->jqlParams['startAt'] = '=' . (int)$startAt;
        $this->jqlParams['maxResults'] = '=' . (int)$maxResults;


        return $this;
    }

    /**
     * Orders results in desc by a column specified
     * @todo Find out all valid columns that can be sorted
     * @param $column
     * @return $this
     */
    public function orderBy($column)
    {
        $this->jqlParams['order+by'] = '+' . (string)$column;
        //'assignee=fred+order+by+key';
        return $this;
    }

    /**
     * Limit the fields that are returned
     * ie:  $fields=id,key
     * @param $fields
     */
    public function selectColumns($fields)
    {

        $this->jqlParams['fields'] = '=' . (string)$fields;
        return $this;
    }

    /**
     * Puts the query together
     */
    public function query()
    {
        $totalJqlParams = count($this->jqlParams);

        $projectKey = '';
        // If project key exists it needs to go first in the jql query to avoid errors
        if (array_key_exists('project', $this->jqlParams)) {

            // The only jql param is project
            if ($totalJqlParams == 1) {
                return $this->createJQL('project' . $this->jqlParams['project']);
            }
            $projectKey = $this->jqlParams['project'];

            unset($this->jqlParams['project']);
            $totalJqlParams = ($totalJqlParams - 1);
        }


        $jqlQuery = '';

        $count = 1;



        foreach ($this->jqlParams as $jqlKey => $jqlVal) {

            if ($count == 1 && $projectKey != '') {
                $jqlQuery .= 'project=' . $projectKey;
               // continue;
            }

            $jqlQuery .= $jqlKey . '' . $jqlVal;
            $jqlQuery .= ($totalJqlParams == $count ? '' : '&');

            $count++;
        }

        return $this->createJQL($jqlQuery);
    }

    private function createJQL($jqlQuery)
    {
        return 'search?jql=' . $jqlQuery;
    }
}