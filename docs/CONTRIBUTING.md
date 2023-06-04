# CONTRIBUTING

[Back](../README.md)

## You must create a PR in Github so I can review your work.

The subject line will be the TASK_KEY - description, can be from the task. for example the subject line of the PR could be `DS-5 - add an account settings area`

## All work needs to originate and be approved from [jira](https://turtlebytes.atlassian.net/jira/software/projects/DS/boards/17)

## Branching strategy - REQUIRED FOR SIGN OFF

To create a branch

### option 1

-   When viewing the task
-   On the right side panel in the details section
-   Click the "Create branch" link which will give you a command like this for example `git checkout -b DS-5-add-an-account-settings-area`

### option 2

anything as long as the branch template matches this `DS-5-add-an-account-settings-area` or `feature/DS-5/add-an-account-settings-area`

the second example `feature/DS-5/add-an-account-settings-area`

-   feature is the task type most will be feature since we're building out
-   task key
-   short description
-   optional - append your github name

So it could be `feature/DS-1/missing-instructor`

So it could be or `feature/DS-1/missing-instructor/zach2825`

## Notes

-   Follow laravel documentation as much as possible
-   For js stuff use typescript as without any, never, unknown as much as possible.
    -   There is a package that generates the typescript interface for all models automatically
