<?php
namespace Jira\Api;

use Jira\Api\HttpRequest;
use Jira\Api\Jira;

class JiraIssues extends Jira
{


    /**
     * Finds and returns project data based on the project key
     * @param $project = Project key  like MYL or RFC
     */
    public function findProject($projectKey)
    {

        $result = $httpRequest = new HttpRequest();
        $result = $httpRequest
            ->setHeaders(['Content-Type: application/json'])
            ->sendRequest($this->project);

        return $result;
    }

    /**
     * Finds all issues based on the JQL query
     * @param $jqlQuery
     */
    public function findByJQL($jqlQuery)
    {
        $httpRequest = new HttpRequest();
        $result = $httpRequest
            ->setHeaders(['Content-Type: application/json'])
            ->sendRequest($this->_createUrl($jqlQuery));

        $decodedResult = json_decode($result);
        return $decodedResult;
    }

    /**
     * Find all issues for a project
     * @param $projectKey
     */
    public function findAllIssuesByProject($projectKey)
    {
        $jql = (new \Jira\Api\Jql())->selectProject($projectKey)->query();

        $httpRequest = new HttpRequest();
        $result = $httpRequest
            ->setHeaders(['Content-Type: application/json'])
            ->sendRequest($this->_createUrl($jql));

        $decodedResult = json_decode($result);

        return $decodedResult;
    }

    /**
     * Creates the full rest URL, ie http: //162.254.144.149:8080/rest/api/2/search?jql=project=MYL&startAt=0&maxResults=1
     * @param $url
     * @return string
     */
    private function _createUrl($url)
    {
        return $this->jiraServerUrl . $url;
    }
}

