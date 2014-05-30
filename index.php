<?php
error_reporting(E_ALL);
ini_set('display_errors', 'yes');
require_once("lib/jira/jira.inc.php");

use Jira\Api\JiraIssues;
use Jira\Api\Jql;
use Jira\Api\IssueParser;


/**
 * Example of how to create a JQL Statement
 *
 * $jql = new Jql();
 * $jql->selectProject('MYL')
 * ->selectColumns('id,key')
 * ->orderBy('id');
 *
 * echo $jql->query();
 *
 * $issuesByJQL = (new JiraIssues)->findByJQL($jql->query());
 * print_r($issuesByJQL);
 */

// Example of how to get all issue by a project keyl
$jiraIssues = new JiraIssues();
$projectIssues = $jiraIssues->findAllIssuesByProject('MYL');
print_r($projectIssues);


/**
 * Example of how to display issue data
 *

$issueParser = new IssueParser();
foreach ($projectIssues->issues as $issueKey => $issueVal) {

echo '<pre>';
print_r($issueVal);
$issueParser->setIssue($issueVal);
// echo $issueParser->setIssue('description');

echo $issueParser->name;
echo $issueParser->description;
echo $issueParser->self;
echo $issueParser->iconUrl;
echo '</pre>';
}
 */
