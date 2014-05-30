jira-php-api
============

Jira PHP API

This library is in the very early stages of development, it is not meant to be used in a production environment yet





How to use


require_once("lib/jira/jira.inc.php");

use Jira\Api\JiraIssues;
use Jira\Api\Jql;
use Jira\Api\IssueParser;



Example usage

JQL is what is used to filter data that you want sent back to you in the API response, I tried to keep the class as similar to a database query builder
found in a lot of popular frameworks

$jql = new Jql();
$jql->selectProject('MYL')
    ->selectColumns('id,key')
    ->orderBy('id');

 * echo $jql->query();

// PHP 5.4 way of finding issues by JQL
$issuesByJQL = (new JiraIssues)->findByJQL($jql->query());



// PHP 5.3 way of finding all issues for a specific project
$jiraIssues = new JiraIssues();
$projectIssues = $jiraIssues->findAllIssuesByProject('MYL');



$issueParser = new IssueParser();
foreach ($projectIssues->issues as $issueKey => $issueVal) {

     $issueParser->setIssue($issueVal);
    echo '<pre>';
    echo $issueParser->name;
    echo $issueParser->description;
    echo $issueParser->self;
    echo $issueParser->iconUrl;
    echo '</pre>';
}

