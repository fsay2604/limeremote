<?php

namespace Evently\LimeRemote\Traits;

use Evently\LimeRemote\Query\LimeRemoteQueryBuilder;

trait LimesurveyRemoteTrait
{
    public function getSessionKey()
    {
        $request = LimeRemoteQueryBuilder::method('get_session_key')
            ->withParams([$this->username, $this->password])
            ->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    public function releaseSessionKey()
    {
        $request = LimeRemoteQueryBuilder::method('release_session_key')
            ->withParams([$this->sessionKey])
            ->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int|null $surveyId
     * @return mixed
     */
    public function activateSurvey(int $surveyId = null)
    {
        $surveyId = (! $surveyId) ? $this->limesurveyId : $surveyId;
        $request = $this->query('activate_survey')->withParams([$surveyId])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int|null $surveyId
     * @param array|null $attributes
     * @return mixed
     */
    public function activateTokens(array $attributes = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $attributes = ($attributes) ? $attributes : [];
        $request = $this->query('activate_tokens')->withParams([$this->limesurveyId, $attributes])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int|null $surveyId
     * @param string $groupTitle
     * @param string|null $groupDescription
     * @return mixed
     */
    public function addGroup(string $groupTitle, string $groupDescription = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('add_group')->withParams([$this->limesurveyId, $groupTitle, $groupDescription])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string $language
     * @return mixed
     */
    public function addLanguage(string $language)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('add_language')->withParams([$this->limesurveyId, $language])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * $participantData example: [ {"email":"me@example.com","lastname":"Bond","firstname":"James"},{"email":"me2@example.com","attribute_1":"example"} ].
     *
     * @param array $participantData
     * @param bool $createToken
     * @return mixed
     */
    public function addParticipants(array $participantData, bool $createToken = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('add_participants')->withParams([$this->limesurveyId, $participantData, $createToken])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param array $responseData
     * @return array The values added
     */
    public function addResponse(array $responseData)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('add_response')->withParams([$this->limesurveyId, $responseData])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int|null $surveyId
     * @param string $surveyTitle
     * @param string $surveyLanguage
     * @param string $format
     * @return mixed int|array The response ID or array with error message
     */
    public function addSurvey(int $surveyId = null, string $surveyTitle, string $surveyLanguage, string $format)
    {
        $request = $this->query('add_survey')->withParams([$surveyId, $surveyTitle, $surveyLanguage, $format])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string $newName
     * @return mixed
     */
    public function copySurvey(string $newName)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('copy_survey')->withParams([$this->limesurveyId, $newName])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param array $particiants ["email"=>"dummy-02222@limesurvey.com","firstname"=>"max","lastname"=>"mustermann"]]
     * @return mixed
     */
    public function cpd_importParticipants(array $particiants)
    {
        $request = $this->query('cpd_importParticipants')->withParams([$particiants])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    public function deleteGroup(int $groupID)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('delete_group')->withParams([$this->limesurveyId, $groupID])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string $language
     * @return mixed
     */
    public function deleteLanguage(string $language)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('delete_language')->withParams([$this->limesurveyId, $language])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param array $tokenIds
     * @return mixed
     */
    public function deleteParticipants(array $tokenIds)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('delete_participants')->withParams([$this->limesurveyId, $tokenIds])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int $questionId
     * @return mixed
     */
    public function deleteQuestion(int $questionId)
    {
        $request = $this->query('delete_question')->withParams([$questionId])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @return mixed
     */
    public function deleteSurvey()
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('delete_survey')->withParams([$this->limesurveyId])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string $documentType
     * @param string|null $languageCode
     * @param string|null $completionStatus
     * @param string|null $headingType
     * @param string|null $responseType
     * @param int|null $fromResponseId
     * @param int|null $toResponseId
     * @param array|null $fields
     * @return mixed
     */
    public function exportResponses(string $documentType, string $languageCode = null, string $completionStatus = null, string $headingType = null, string $responseType = null, int $fromResponseId = null, int $toResponseId = null, array $fields = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('export_responses')->withParams([$this->limesurveyId, $documentType, $languageCode, $completionStatus, $headingType, $responseType, $fromResponseId, $toResponseId, $fields])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string|null $documentType
     * @param string $token
     * @param string|null $languageCode
     * @param string|null $completionStatus
     * @param string|null $headingType
     * @param string|null $responseType
     * @param int|null $fromResponseId
     * @param int|null $toResponseId
     * @param array|null $fields
     * @return mixed
     */
    public function exportResponsesByToken(string $documentType, string $token, string $languageCode = null, string $completionStatus = null, string $headingType = null, string $responseType = null, int $fromResponseId = null, int $toResponseId = null, array $fields = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('export_responses_by_token')->withParams([$this->limesurveyId, $documentType, $token, $languageCode, $completionStatus, $headingType, $responseType, $fromResponseId, $toResponseId, $fields])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string|null $docType
     * @param string|null $language
     * @param string|null $graph
     * @param null $groupIds
     * @return mixed
     */
    public function exportStatistics(string $docType = null, string $language = null, string $graph = null, $groupIds = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('export_statistics')->withParams([$this->limesurveyId, $docType, $language, $graph, $groupIds])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string $type day|hour
     * @param string $start datetime string
     * @param string $end datetime string (eg Carbon ->toDateTimeString()
     * @return mixed
     */
    public function exportTimeline(string $type, string $start, string $end)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('export_timeline')->withParams([$this->limesurveyId, $type, $start, $end])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int $groupId
     * @param array $groupSettings
     * @return mixed
     */
    public function getGroupProperties(int $groupId, array $groupSettings)
    {
        $request = $this->query('get_group_properties')->withParams([$groupId, $groupSettings])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param array|null $surveyLocaleSettings   Properties to get, default to all attributes
     * @param string|null $lang  Language to use, default to Survey->language
     * @return mixed
     */
    public function getLanguageProperties(array $surveyLocaleSettings = null, string $lang = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('get_language_properties')->withParams([$this->limesurveyId, $surveyLocaleSettings, $lang])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param array|int $tokenQueryProperties Properties of participant properties used to query the participant, or the token id as an integer
     * @param array $tokenProperties The properties to get
     * @return mixed
     */
    public function getParticipantProperties(array $tokenQueryProperties, array $tokenProperties)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('get_participant_properties')->withParams([$this->limesurveyId, $tokenQueryProperties, $tokenProperties])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int $questionID
     * @param array $questionSettings (optional) properties to get, default to all
     * @param string $language
     * @return mixed
     */
    public function getQuestionProperties(int $questionID, array $questionSettings = null, string $language = null)
    {
        $request = $this->query('get_question_properties')->withParams([$questionID, $questionSettings, $language])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int $surveyID
     * @param string $token
     * @return mixed
     */
    public function getResponseIds(int $surveyID, string $token)
    {
        $request = $this->query('get_response_ids')->withParams([$surveyID, $token])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    //get session key -> see top

    /**
     * @param string $setttingName
     * @return mixed
     */
    public function getSiteSettings(string $setttingName)
    {
        $request = $this->query('get_site_settings')->withParams([$setttingName])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string|null $statName defaults to all stats
     * Available stats:
     * For Survey stats
     *     completed_responses
     *     incomplete_responses
     *     full_responses
     * For token part
     *     token_count
     *     token_invalid
     *     token_sent
     *     token_opted_out
     *     token_completed
     * @return mixed
     */
    public function getSummary(string $statName = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('get_summary')->withParams([$this->limesurveyId, $statName])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param array|null $surveySettings
     * @return mixed
     */
    public function getSurveyProperties(array $surveySettings = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('get_survey_properties')->withParams([$this->limesurveyId, $surveySettings])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string $token
     * @return mixed
     */
    public function getUploadedFiles(string $token)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('get_uploaded_files')->withParams([$this->limesurveyId, $token])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string $importData string containing the BASE 64 encoded data of a lsg,csv
     * @param string $importDataType lsg,csv
     * @param string|null $newGroupName
     * @param string|null $newGroupDescription
     * @return mixed
     */
    public function importGroup($importData, string $importDataType, string $newGroupName = null, string $newGroupDescription = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('import_group')->withParams([$this->limesurveyId, $importData, $importDataType, $newGroupName, $newGroupDescription])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int $groupId
     * @param string $importData
     * @param string|null $mandatory
     * @param string|null $newQuestionTitle
     * @param string|null $newqQuestion
     * @param string|null $newQuestionHelp
     * @return mixed
     */
    public function importQuestion(int $groupId, string $importData, string $sImportDataType, string $mandatory = null, string $newQuestionTitle = null, string $newqQuestion = null, string $newQuestionHelp = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('import_question')->withParams([$this->limesurveyId, $groupId, $importData, 'lsq', $mandatory, $newQuestionTitle, $newqQuestion, $newQuestionHelp])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string $importData    String containing the BASE 64 encoded data of a lss, csv, txt or survey lsa archive
     * @param string $importDataType    lss, csv, txt or lsa
     * @param string|null $newSurveyName
     * @param int|null $destSurveyID
     * @return mixed
     */
    public function importSurvey(string $importData, string $importDataType, string $newSurveyName = null, int $destSurveyID = null)
    {
        $request = $this->query('import_survey')->withParams([$importData, $importDataType, $newSurveyName, $destSurveyID])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param array|null $tokenIds
     * @param bool|null $email
     * @return mixed
     */
    public function inviteParticipants(array $tokenIds = null, bool $email = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('invite_participants')->withParams([$this->limesurveyId, $tokenIds, $email])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @return mixed
     */
    public function listGroups()
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('list_groups')->withParams([$this->limesurveyId])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int $start
     * @param int $limit
     * @param bool|null $unused
     * @param array|null $attributes
     * @param array $conditions
     * @return mixed
     */
    public function listParticipants(int $start, int $limit, bool $unused = null, array $attributes = null, array $conditions = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('list_participants')->withParams([$this->limesurveyId, $start, $limit, $unused, $attributes, $conditions])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int $groupId
     * @param string $language
     * @return mixed
     */
    public function listQuestions(int $groupId = null, string $language = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('list_questions')->withParams([$this->limesurveyId, $groupId, $language])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string|null $username
     * @return mixed
     */
    public function listSurveys(string $username = null)
    {
        $request = $this->query('list_surveys')->withParams([$username])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int|null $uid
     * @return mixed
     */
    public function listUsers(int $uid = null)
    {
        $request = $this->query('list_users')->withParams([$uid])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param array|null $overrideAllConditions
     * @return mixed
     */
    public function mailRegisteredParticipants(array $overrideAllConditions = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('mail_registered_participants')->withParams([$this->limesurveyId, $overrideAllConditions])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

//    releaseSessionKey -> see top

    /**
     * @param int|null $minDaysBetween
     * @param int|null $maxReminders
     * @param array|null $tokenIds
     * @return mixed
     */
    public function remindParticipants(int $minDaysBetween = null, int $maxReminders = null, array $tokenIds = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('remind_participants')->withParams([$this->limesurveyId, $minDaysBetween, $maxReminders, $tokenIds])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int $groupID
     * @param array $groupData
     * @return mixed
     */
    public function setGroupProperties(int $groupID, array $groupData)
    {
        $request = $this->query('set_group_properties')->withParams([$groupID, $groupData])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param array $surveyLocaleData
     * @param string|null $language
     * @return mixed
     */
    public function setLanguageProperties(array $surveyLocaleData, string $language = null)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('set_language_properties')->withParams([$this->limesurveyId, $surveyLocaleData, $language])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    public function setParticipantProperties($tokenQueryProperties, array $tokenData)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('set_participant_properties')->withParams([$this->limesurveyId, $tokenQueryProperties, $tokenData])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int $questionID
     * @param array $questionData
     * @param string|null $language
     * @return mixed
     */
    public function setQuestionProperties(int $questionID, array $questionData, string $language = null)
    {
        $request = $this->query('set_question_properties')->withParams([$questionID, $questionData, $language])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param int $quotaId
     * @param array $quotaData
     * @return mixed
     */
    public function setQuotaProperties(int $quotaId, array $quotaData)
    {
        $request = $this->query('set_quota_properties')->withParams([$quotaId, $quotaData])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param array $surveyData
     * @return mixed
     */
    public function setSurveyProperties(array $surveyData)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('set_survey_properties')->withParams([$this->limesurveyId, $surveyData])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param array $responseData
     * @return mixed
     */
    public function updateResponse(array $responseData)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('update_response')->withParams([$this->limesurveyId, $responseData])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    /**
     * @param string $fieldName
     * @param string $fileName
     * @param string $fileContent Base64 encoded
     * @return mixed
     */
    public function uploadFile(string $fieldName, string $fileName, string $fileContent)
    {
        if (! $this->isLimesurveyIdSet()) {
            return ['error'=>'Limesurvey Id not set'];
        }
        $request = $this->query('upload_file')->withParams([$this->limesurveyId, $fieldName, $fileName, $fileContent])->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    public function genericRemoteQuery(string $query, array $queryAttributes)
    {
        $request = $this->query($query)->withParams($queryAttributes)->build();
        $result = $this->client->call($request[0], $request[1]);

        return $result;
    }

    protected function query(string $type): LimeRemoteQueryBuilder
    {
        return LimeRemoteQueryBuilder::method($type)->withSessionKey($this->sessionKey);
    }
}
