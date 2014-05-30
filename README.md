This is a PHP Library used to work with the Jira API. It's in the very early stages of development and should not be used in a production environment <br /><br />


**Example of how to create a JQL Statement**

`$jql = new Jql();`

`$jql->selectProject('MYL')`<br />
  `->selectColumns('id,key')`<br />
  `->orderBy('id');`<br />
 
  `$jqlQuery = $jql->query();`
 
**Find Jira Issues By JQL**<br />
 `$issuesByJQL = (new JiraIssues)->findByJQL($jqlQuery);`



**Find All Jira Issues By Project**<br />
`$jiraIssues = new JiraIssues();`<br />
`$projectIssues = $jiraIssues->findAllIssuesByProject('MYL');`<br />
<br />

**Easily Display Issue Data Sent From the Jira Api**<br />
`$issueParser = new IssueParser();`<br />
`foreach ($projectIssues->issues as $issueKey => $issueVal) {`<br />

`echo '<pre>';`<br />
`print_r($issueVal);`<br />
`$issueParser->setIssue($issueVal);`<br />
`// echo $issueParser->setIssue('description');`<br />

`echo $issueParser->name;`<br />
`echo $issueParser->description;`<br />
`echo $issueParser->self;`<br />
`echo $issueParser->iconUrl;`<br />
`echo '</pre>';`<br />
`}`
 