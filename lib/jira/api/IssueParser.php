<?php
namespace Jira\Api;

/**
 * Class IssueParser
 * @package Java\Api
 *
 * Parses a single Jira issue
 *
 * @var string $description
 */
class IssueParser
{
    protected $issue;

    protected $issueTypes = [
        'self',
        'id',
        'description',
        'iconUrl',
        'name',
        'subtask'
    ];

    /**
     * Constructor
     * Set issue var if passed
     * @param string $issue
     */
    public function __construct($issue = '')
    {
        if ($issue != "") {
            $this->issue = $issue;
        }
    }

    /**
     * Set Issue variable and create issueTypes
     * @param $issue
     */
    public function setIssue($issue)
    {
        $this->issue = $issue;

        $this->setIssueTypes($issue);
    }

    /**
     * Sets issue variables so they can be called like
     * $issueParser->self, $issueParser->id, etc
     */
    protected function setIssueTypes($issue)
    {
        foreach ($this->issueTypes as $issueType) {
            $issueTypeVar = $this->issue->fields->issuetype->$issueType;
            $this->$issueType = $issueTypeVar;
        }
    }

}