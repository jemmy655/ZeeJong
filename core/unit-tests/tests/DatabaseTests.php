<?php

namespace UnitTest;

require_once(dirname(__FILE__) . '/../../../database.php');
require_once(dirname(__FILE__) . '/../../../config.php');
require_once(dirname(__FILE__) . '/../../unit-test.php');

class BasicCountryTest extends UnitTest {

    private $db;
    private $countryName1;
    private $countryName2;
    private $countryName3;
    private $countryId1;
    private $countryId2;
    private $countryId3;



    public function __construct() {

        $this->countryName1 = "Germanolia";
        $this->countryName2 = "Francibium";
        $this->countryName3 = "Molta";
        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;

        $this->countryId1 = $this->db->addCountry($this->countryName1);
        $this->countryId2 = $this->db->addCountry($this->countryName2);
        $this->countryId3 = $this->db->addCountry($this->countryName3);
    }

    public function basicGetters() {

        $this->REQUIRE_EQUAL($this->db->getCountryById($this->countryId1)->getName(), $this->countryName1);
        $this->REQUIRE_EQUAL($this->db->getCountryById($this->countryId2)->getName(), $this->countryName2);
        $this->REQUIRE_EQUAL($this->db->getCountryById($this->countryId3)->getName(), $this->countryName3);
        $this->REQUIRE_NOTEQUAL($this->db->getCountryById($this->countryId1)->getName(), $this->countryName2);
        $this->REQUIRE_NOTEQUAL($this->db->getCountryById($this->countryId2)->getName(), $this->countryName3);
        $this->REQUIRE_NOTEQUAL($this->db->getCountryById($this->countryId3)->getName(), $this->countryName1);
    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->db->addCountry($this->countryName1), $this->countryId1);
        $this->REQUIRE_EQUAL($this->db->addCountry($this->countryName2), $this->countryId2);
        $this->REQUIRE_EQUAL($this->db->addCountry($this->countryName3), $this->countryId3);
    }

}

class BasicCoachTest extends UnitTest {

    private $db;
    private $id1;
    private $id2;
    private $id3;
    private $firstName1;
    private $firstName2;
    private $firstName3;
    private $lastName1;
    private $lastName2;
    private $lastName3;
    private $countryId1;
    private $countryId2;
    private $countryId3;



    public function __construct() {

        $this->firstName1 = "Coach";
        $this->firstName2 = "Buck";
        $this->firstName3 = "Dick";
        $this->lastName1 = "Coacherson";
        $this->lastName2 = "Buckington";
        $this->lastName3 = "Taiter";
        $this->countryId1 = 1;
        $this->countryId2 = 3;
        $this->countryId3 = 3;

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;

        $this->id1 = $this->db->addCoach($this->firstName1, $this->lastName1, $this->countryId1);
        $this->id2 = $this->db->addCoach($this->firstName2, $this->lastName2, $this->countryId2);
        $this->id3 = $this->db->addCoach($this->firstName3, $this->lastName3, $this->countryId3);
    }

    public function basicGetters() {

        //Check first name
        $this->REQUIRE_EQUAL($this->db->getCoachById($this->id1)->getFirstName(), $this->firstName1);
        $this->REQUIRE_EQUAL($this->db->getCoachById($this->id2)->getFirstName(), $this->firstName2);
        $this->REQUIRE_EQUAL($this->db->getCoachById($this->id3)->getFirstName(), $this->firstName3);

        //Check last name
        $this->REQUIRE_EQUAL($this->db->getCoachById($this->id1)->getLastName(), $this->lastName1);
        $this->REQUIRE_EQUAL($this->db->getCoachById($this->id2)->getLastName(), $this->lastName2);
        $this->REQUIRE_EQUAL($this->db->getCoachById($this->id3)->getLastName(), $this->lastName3);

        //Check countries
        $this->REQUIRE_EQUAL($this->db->getCoachById($this->id1)->getCountry()->getId(), $this->countryId1);
        $this->REQUIRE_EQUAL($this->db->getCoachById($this->id2)->getCountry()->getId(), $this->countryId2);
        $this->REQUIRE_EQUAL($this->db->getCoachById($this->id3)->getCountry()->getId(), $this->countryId3);
    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->db->addCoach($this->firstName1, $this->lastName1, $this->countryId1), $this->id1);
        $this->REQUIRE_EQUAL($this->db->addCoach($this->firstName2, $this->lastName2, $this->countryId2), $this->id2);
        $this->REQUIRE_EQUAL($this->db->addCoach($this->firstName3, $this->lastName3, $this->countryId3), $this->id3);
    }

}


class BasicPlayerTest extends UnitTest {

    private $db;
    private $id1;
    private $firstName1;
    private $lastName1;
    private $countryId1;
    private $dateOfBirth1;
    private $height1;
    private $weight1;
    private $position1;
    private $imageUrl1;
    private $id2;
    private $firstName2;
    private $lastName2;
    private $countryId2;
    private $dateOfBirth2;
    private $height2;
    private $weight2;
    private $position2;
    private $imageUrl2;
    private $id3;
    private $firstName3;
    private $lastName3;
    private $countryId3;
    private $dateOfBirth3;
    private $height3;
    private $weight3;
    private $position3;
    private $imageUrl3;

    public function __construct() {

        $this->firstName1 = "Timo";
        $this->lastName1 = "Truyts";
        $this->countryId1 = 1;
        $this->dateOfBirth1 = 124;
        $this->height1 = 168;
        $this->weight1 = 70;
        $this->position1 = "Defender";
        $this->firstName2 = "Mathias";
        $this->lastName2 = "Beke";
        $this->countryId2 = 2;
        $this->dateOfBirth2 = 125;
        $this->height2 = 180;
        $this->weight2 = 89;
        $this->position2 = "Attacker";
        $this->firstName3 = "Bruno";
        $this->lastName3 = "VDV";
        $this->countryId3 = 3;
        $this->dateOfBirth3 = 183;
        $this->height3 = 182;
        $this->weight3 = 43;
        $this->position3 = "Playmaker";

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = &$db;

        $this->id1 = $this->db->addPlayer($this->firstName1, $this->lastName1, $this->countryId1, $this->dateOfBirth1, $this->height1, $this->weight1, $this->position1);
        $this->id2 = $this->db->addPlayer($this->firstName2, $this->lastName2, $this->countryId2, $this->dateOfBirth2, $this->height2, $this->weight2, $this->position2);
        $this->id3 = $this->db->addPlayer($this->firstName3, $this->lastName3, $this->countryId3, $this->dateOfBirth3, $this->height3, $this->weight3, $this->position3);

    }

    public function basicGetters() {

        //Checking first names
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id1)->getFirstName(), $this->firstName1);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id2)->getFirstName(), $this->firstName2);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id3)->getFirstName(), $this->firstName3);

        //Checking last names
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id1)->getLastName(), $this->lastName1);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id2)->getLastName(), $this->lastName2);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id3)->getLastName(), $this->lastName3);

        //Checking countries
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id1)->getCountry()->getId(), $this->countryId1);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id2)->getCountry()->getId(), $this->countryId2);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id3)->getCountry()->getId(), $this->countryId3);

        //Checking date of birth
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id1)->getDateOfBirth(), $this->dateOfBirth1);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id2)->getDateOfBirth(), $this->dateOfBirth2);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id3)->getDateOfBirth(), $this->dateOfBirth3);

        //Checking height
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id1)->getHeight(), $this->height1);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id2)->getHeight(), $this->height2);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id3)->getHeight(), $this->height3);

        //Checking weight
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id1)->getWeight(), $this->weight1);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id2)->getWeight(), $this->weight2);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id3)->getWeight(), $this->weight3);

        //Checking position
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id1)->getPosition(), $this->position1);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id2)->getPosition(), $this->position2);
        $this->REQUIRE_EQUAL($this->db->getPlayerById($this->id3)->getPosition(), $this->position3);
    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->db->addPlayer($this->firstName1, $this->lastName1, $this->countryId1, $this->dateOfBirth1, $this->height1, $this->weight1, $this->position1), $this->id1);
        $this->REQUIRE_EQUAL($this->db->addPlayer($this->firstName2, $this->lastName2, $this->countryId2, $this->dateOfBirth2, $this->height2, $this->weight2, $this->position2), $this->id2);
        $this->REQUIRE_EQUAL($this->db->addPlayer($this->firstName3, $this->lastName3, $this->countryId3, $this->dateOfBirth3, $this->height3, $this->weight3, $this->position3), $this->id3);
    }

}

class BasicRefereeTest extends UnitTest {

    private $db;
    private $id1;
    private $firstName1;
    private $lastName1;
    private $countryId1;
    private $id2;
    private $firstName2;
    private $lastName2;
    private $countryId2;
    private $id3;
    private $firstName3;
    private $lastName3;
    private $countryId3;


    public function __construct() {

        $this->firstName1 = "Rovax";
        $this->lastName1 = "R";
        $this->countryId1 = 1;
        $this->firstName2 = "Blackburth";
        $this->lastName2 = "Bb";
        $this->countryId2 = 2;
        $this->firstName3 = "Eli";
        $this->lastName3 = "VL";
        $this->countryId3 = 3;

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = &$db;

        $this->id1 = $this->db->addReferee($this->firstName1, $this->lastName1, $this->countryId1);
        $this->id2 = $this->db->addReferee($this->firstName2, $this->lastName2, $this->countryId2);
        $this->id3 = $this->db->addReferee($this->firstName3, $this->lastName3, $this->countryId3);

    }

    public function basicGetters() {

        //Checking first names
        $this->REQUIRE_EQUAL($this->db->getRefereeById($this->id1)->getFirstName(), $this->firstName1);
        $this->REQUIRE_EQUAL($this->db->getRefereeById($this->id2)->getFirstName(), $this->firstName2);
        $this->REQUIRE_EQUAL($this->db->getRefereeById($this->id3)->getFirstName(), $this->firstName3);

        //Checking last names
        $this->REQUIRE_EQUAL($this->db->getRefereeById($this->id1)->getLastName(), $this->lastName1);
        $this->REQUIRE_EQUAL($this->db->getRefereeById($this->id2)->getLastName(), $this->lastName2);
        $this->REQUIRE_EQUAL($this->db->getRefereeById($this->id3)->getLastName(), $this->lastName3);

        //Checking countries
        $this->REQUIRE_EQUAL($this->db->getRefereeById($this->id1)->getCountry()->getId(), $this->countryId1);
        $this->REQUIRE_EQUAL($this->db->getRefereeById($this->id2)->getCountry()->getId(), $this->countryId2);
        $this->REQUIRE_EQUAL($this->db->getRefereeById($this->id3)->getCountry()->getId(), $this->countryId3);
    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->db->addReferee($this->firstName1, $this->lastName1, $this->countryId1), $this->id1);
        $this->REQUIRE_EQUAL($this->db->addReferee($this->firstName2, $this->lastName2, $this->countryId2), $this->id2);
        $this->REQUIRE_EQUAL($this->db->addReferee($this->firstName3, $this->lastName3, $this->countryId3), $this->id3);
    }

}


class BasicTeamTest extends UnitTest {

    private $db;
    private $id1;
    private $name1;
    private $country1;
    private $countryId1;
    private $id2;
    private $name2;
    private $country2;
    private $countryId2;
    private $id3;
    private $name3;
    private $country3;
    private $countryId3;

    public function __construct() {

        $this->name1 = "De Timos";
        $this->country1 = "Germanolia";
        $this->countryId1 = 1;
        $this->name2 = "De Mathiassen";
        $this->country2 = "Francibium";
        $this->countryId2 = 2;
        $this->name3 = "Funkyzeit mit Bruno";
        $this->country3 = "Molta";
        $this->countryId3 = 3;

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = &$db;

        $this->id1 = $this->db->addTeam($this->name1, $this->countryId1);
        $this->id2 = $this->db->addTeam($this->name2, $this->countryId2);
        $this->id3 = $this->db->addTeam($this->name3, $this->countryId3);

    }

    public function basicGetters() {

        //Checking names
        $this->REQUIRE_EQUAL($this->db->getTeamById($this->id1)->getName(), $this->name1);
        $this->REQUIRE_EQUAL($this->db->getTeamById($this->id2)->getName(), $this->name2);
        $this->REQUIRE_EQUAL($this->db->getTeamById($this->id3)->getName(), $this->name3);

        //Checking countries
        $this->REQUIRE_EQUAL($this->db->getTeamById($this->id1)->getCountry()->getName(), $this->country1);
        $this->REQUIRE_EQUAL($this->db->getTeamById($this->id2)->getCountry()->getName(), $this->country2);
        $this->REQUIRE_EQUAL($this->db->getTeamById($this->id3)->getCountry()->getName(), $this->country3);
    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->db->addTeam($this->name1, $this->countryId1), $this->id1);
        $this->REQUIRE_EQUAL($this->db->addTeam($this->name2, $this->countryId2), $this->id2);
        $this->REQUIRE_EQUAL($this->db->addTeam($this->name3, $this->countryId3), $this->id3);
    }
}

class BasicCompetitionTest extends UnitTest {

    private $db;
    private $id1;
    private $name1;
    private $id2;
    private $name2;
    private $id3;
    private $name3;

    public function __construct() {

        $this->name1 = "Death Battle";
        $this->name2 = "Life Battle";
        $this->name3 = "Coma Battle";

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = &$db;

        $this->id1 = $this->db->addCompetition($this->name1);
        $this->id2 = $this->db->addCompetition($this->name2);
        $this->id3 = $this->db->addCompetition($this->name3);

    }

    public function basicGetters() {

        //Checking names
        $this->REQUIRE_EQUAL($this->db->getCompetitionById($this->id1)->getName(), $this->name1);
        $this->REQUIRE_EQUAL($this->db->getCompetitionById($this->id2)->getName(), $this->name2);
        $this->REQUIRE_EQUAL($this->db->getCompetitionById($this->id3)->getName(), $this->name3);

    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->db->addCompetition($this->name1), $this->id1);
        $this->REQUIRE_EQUAL($this->db->addCompetition($this->name2), $this->id2);
        $this->REQUIRE_EQUAL($this->db->addCompetition($this->name3), $this->id3);
    }
}

class BasicTournamentTest extends UnitTest {

    private $db;
    private $id1;
    private $name1;
    private $compId1;
    private $id2;
    private $name2;
    private $compId2;
    private $id3;
    private $name3;
    private $compId3;
    private $id4;
    private $name4;
    private $compId4;


    public function __construct() {

        $this->name1 = "Death Battle 1";
        $this->compId1 = 1;
        $this->name2 = "Life Battle 1";
        $this->compId2 = 2;
        $this->name3 = "Coma Battle 1";
        $this->compId3 = 3;
        $this->name4 = "Death Battle 2";
        $this->compId4 = 1;

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = &$db;

        $this->id1 = $this->db->addTournament($this->name1, $this->compId1);
        $this->id2 = $this->db->addTournament($this->name2, $this->compId2);
        $this->id3 = $this->db->addTournament($this->name3, $this->compId3);
        $this->id4 = $this->db->addTournament($this->name4, $this->compId4);


    }

    public function basicGetters() {

        //Checking names
        $this->REQUIRE_EQUAL($this->db->getTournamentById($this->id1)->getName(), $this->name1);
        $this->REQUIRE_EQUAL($this->db->getTournamentById($this->id2)->getName(), $this->name2);
        $this->REQUIRE_EQUAL($this->db->getTournamentById($this->id3)->getName(), $this->name3);
        $this->REQUIRE_EQUAL($this->db->getTournamentById($this->id4)->getName(), $this->name4);

        //Checking competitions
        $this->REQUIRE_EQUAL($this->db->getTournamentById($this->id1)->getCompetition()->getId(), $this->compId1);
        $this->REQUIRE_EQUAL($this->db->getTournamentById($this->id2)->getCompetition()->getId(), $this->compId2);
        $this->REQUIRE_EQUAL($this->db->getTournamentById($this->id3)->getCompetition()->getId(), $this->compId3);
        $this->REQUIRE_EQUAL($this->db->getTournamentById($this->id4)->getCompetition()->getId(), $this->compId4);

    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->db->addTournament($this->name1, $this->compId1), $this->id1);
        $this->REQUIRE_EQUAL($this->db->addTournament($this->name2, $this->compId2), $this->id2);
        $this->REQUIRE_EQUAL($this->db->addTournament($this->name3, $this->compId3), $this->id3);
        $this->REQUIRE_EQUAL($this->db->addTournament($this->name4, $this->compId4), $this->id4);
    }
}

class BasicMatchTest extends UnitTest {

    private $db;

    private $id1;
    private $teamAId1;
    private $teamBId1;
    private $tournamentId1;
    private $refId1;
    private $date1;
    private $scoreId1;
    private $scoreTeamA1;
    private $scoreTeamB1;

    private $id2;
    private $teamAId2;
    private $teamBId2;
    private $tournamentId2;
    private $refId2;
    private $date2;
    private $scoreId2;
    private $scoreTeamA2;
    private $scoreTeamB2;

    private $id3;
    private $teamAId3;
    private $teamBId3;
    private $tournamentId3;
    private $refId3;
    private $date3;
    private $scoreId3;
    private $scoreTeamA3;
    private $scoreTeamB3;

    private $id4;
    private $teamAId4;
    private $teamBId4;
    private $tournamentId4;
    private $refId4;
    private $date4;
    private $scoreId4;
    private $scoreTeamA4;
    private $scoreTeamB4;

    public function __construct() {

        $this->teamAId1 = 1;
        $this->teamBId1 = 2;
        $this->tournamentId1 = 1;
        $this->refId1 = 1;
        $this->date1 = 1245681;
        $this->scoreTeamA1 = 1;
        $this->scoreTeamB1 = 3;

        $this->teamAId2 = 3;
        $this->teamBId2 = 1;
        $this->tournamentId2 = 1;
        $this->refId2 = 1;
        $this->date2 = 15121;
        $this->scoreTeamA2 = 3;
        $this->scoreTeamB2 = 2;

        $this->teamAId3 = 2;
        $this->teamBId3 = 3;
        $this->tournamentId3 = 1;
        $this->refId3 = 2;
        $this->date3 = 1214512;
        $this->scoreTeamA3 = 0;
        $this->scoreTeamB3 = 1;

        $this->teamAId4 = 3;
        $this->teamBId4 = 1;
        $this->tournamentId4 = 2;
        $this->refId4 = 1;
        $this->date4 = 158154;
        $this->scoreTeamA4 = 1;
        $this->scoreTeamB4 = 1;

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = &$db;



        $this->id1 = $this->db->addMatch($this->teamAId1, $this->teamBId1, $this->scoreTeamA1, $this->scoreTeamB1, $this->refId1, $this->date1, $this->tournamentId1);
        $this->id2 = $this->db->addMatch($this->teamAId2, $this->teamBId2, $this->scoreTeamA2, $this->scoreTeamB2, $this->refId2, $this->date2, $this->tournamentId2);
        $this->id3 = $this->db->addMatch($this->teamAId3, $this->teamBId3, $this->scoreTeamA3, $this->scoreTeamB3, $this->refId3, $this->date3, $this->tournamentId3);
        $this->id4 = $this->db->addMatch($this->teamAId4, $this->teamBId4, $this->scoreTeamA4, $this->scoreTeamB4, $this->refId4, $this->date4, $this->tournamentId4);
    }

    public function basicGetters() {

        //check teams
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id1)->getTeamA()->getId(), $this->teamAId1);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id2)->getTeamA()->getId(), $this->teamAId2);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id3)->getTeamA()->getId(), $this->teamAId3);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id4)->getTeamA()->getId(), $this->teamAId4);

        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id1)->getTeamB()->getId(), $this->teamBId1);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id2)->getTeamB()->getId(), $this->teamBId2);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id3)->getTeamB()->getId(), $this->teamBId3);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id4)->getTeamB()->getId(), $this->teamBId4);


        //check tournaments
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id1)->getTournament()->getId(), $this->tournamentId1);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id2)->getTournament()->getId(), $this->tournamentId2);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id3)->getTournament()->getId(), $this->tournamentId3);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id4)->getTournament()->getId(), $this->tournamentId4);


        //check referees
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id1)->getReferee()->getId(), $this->refId1);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id2)->getReferee()->getId(), $this->refId2);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id3)->getReferee()->getId(), $this->refId3);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id4)->getReferee()->getId(), $this->refId4);


        //check dates
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id1)->getDate(), $this->date1);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id2)->getDate(), $this->date2);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id3)->getDate(), $this->date3);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id4)->getDate(), $this->date4);


        //check scores
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id1)->getScore()->getScoreA(), $this->scoreTeamA1);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id2)->getScore()->getScoreA(), $this->scoreTeamA2);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id3)->getScore()->getScoreA(), $this->scoreTeamA3);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id4)->getScore()->getScoreA(), $this->scoreTeamA4);

        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id1)->getScore()->getScoreB(), $this->scoreTeamB1);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id2)->getScore()->getScoreB(), $this->scoreTeamB2);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id3)->getScore()->getScoreB(), $this->scoreTeamB3);
        $this->REQUIRE_EQUAL($this->db->getMatchById($this->id4)->getScore()->getScoreB(), $this->scoreTeamB4);
    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->id1, $this->db->addMatch($this->teamAId1, $this->teamBId1, $this->scoreTeamA1, $this->scoreTeamB1, $this->refId1, $this->date1, $this->tournamentId1));
        $this->REQUIRE_EQUAL($this->id2, $this->db->addMatch($this->teamAId2, $this->teamBId2, $this->scoreTeamA2, $this->scoreTeamB2, $this->refId2, $this->date2, $this->tournamentId2));
        $this->REQUIRE_EQUAL($this->id3, $this->db->addMatch($this->teamAId3, $this->teamBId3, $this->scoreTeamA3, $this->scoreTeamB3, $this->refId3, $this->date3, $this->tournamentId3));
        $this->REQUIRE_EQUAL($this->id4, $this->db->addMatch($this->teamAId4, $this->teamBId4, $this->scoreTeamA4, $this->scoreTeamB4, $this->refId4, $this->date4, $this->tournamentId4));
    }
}

class BasicCardTest extends UnitTest {

    private $db;

    private $id1;
    private $playerId1;
    private $matchId1;
    private $time1;
    private $color1;

    private $id2;
    private $playerId2;
    private $matchId2;
    private $time2;
    private $color2;

    private $id3;
    private $playerId3;
    private $matchId3;
    private $time3;
    private $color3;

    private $id4;
    private $playerId4;
    private $matchId4;
    private $time4;
    private $color4;



    public function __construct() {

        $this->playerId1 = 1;
        $this->matchId1 = 2;
        $this->time1 = 1245681;
        $this->color1 = 1;

        $this->playerId2 = 2;
        $this->matchId2 = 2;
        $this->time2 = 12548;
        $this->color2 = 1;

        $this->playerId3 = 1;
        $this->matchId3 = 2;
        $this->time3 = 124811;
        $this->color3 = 2;

        $this->playerId4 = 3;
        $this->matchId4 = 1;
        $this->time4 = 154513;
        $this->color4 = 2;

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = &$db;



        $this->id1 = $this->db->addFoulCard($this->playerId1, $this->matchId1, $this->time1, $this->color1);
        $this->id2 = $this->db->addFoulCard($this->playerId2, $this->matchId2, $this->time2, $this->color2);
        $this->id3 = $this->db->addFoulCard($this->playerId3, $this->matchId3, $this->time3, $this->color3);
        $this->id4 = $this->db->addFoulCard($this->playerId4, $this->matchId4, $this->time4, $this->color4);

    }

    public function basicGetters() {

        //check players
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id1)->getPlayer()->getId(), $this->playerId1);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id2)->getPlayer()->getId(), $this->playerId2);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id3)->getPlayer()->getId(), $this->playerId3);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id4)->getPlayer()->getId(), $this->playerId4);


        //check matches
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id1)->getMatch()->getId(), $this->matchId1);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id2)->getMatch()->getId(), $this->matchId2);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id3)->getMatch()->getId(), $this->matchId3);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id4)->getMatch()->getId(), $this->matchId4);


        //check referees
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id1)->getTime(), $this->time1);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id2)->getTime(), $this->time2);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id3)->getTime(), $this->time3);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id4)->getTime(), $this->time4);


        //check dates
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id1)->getColor(), $this->color1);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id2)->getColor(), $this->color2);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id3)->getColor(), $this->color3);
        $this->REQUIRE_EQUAL($this->db->getFoulCardById($this->id4)->getColor(), $this->color4);

    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->id1, $this->db->addFoulCard($this->playerId1, $this->matchId1, $this->time1, $this->color1));
        $this->REQUIRE_EQUAL($this->id2, $this->db->addFoulCard($this->playerId2, $this->matchId2, $this->time2, $this->color2));
        $this->REQUIRE_EQUAL($this->id3, $this->db->addFoulCard($this->playerId3, $this->matchId3, $this->time3, $this->color3));
        $this->REQUIRE_EQUAL($this->id4, $this->db->addFoulCard($this->playerId4, $this->matchId4, $this->time4, $this->color4));
    }
}

class BasicGoalTest extends UnitTest {

    private $db;

    private $id1;
    private $playerId1;
    private $matchId1;
    private $time1;

    private $id2;
    private $playerId2;
    private $matchId2;
    private $time2;

    private $id3;
    private $playerId3;
    private $matchId3;
    private $time3;

    private $id4;
    private $playerId4;
    private $matchId4;
    private $time4;


    public function __construct() {

        $this->playerId1 = 1;
        $this->matchId1 = 1;
        $this->time1 = 513218;

        $this->playerId2 = 2;
        $this->matchId2 = 1;
        $this->time2 = 2168413;

        $this->playerId3 = 3;
        $this->matchId3 = 2;
        $this->time3 = 1531218;

        $this->playerId4 = 1;
        $this->matchId4 = 1;
        $this->time4 = 216163;

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;

        $this->id1 = $this->db->addGoal($this->playerId1, $this->time1, $this->matchId1);
        $this->id2 = $this->db->addGoal($this->playerId2, $this->time2, $this->matchId2);
        $this->id3 = $this->db->addGoal($this->playerId3, $this->time3, $this->matchId3);
        $this->id4 = $this->db->addGoal($this->playerId4, $this->time4, $this->matchId4);

    }

    public function basicGetters() {

        //Check players
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id1)->getPlayer()->getId(), $this->playerId1);
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id2)->getPlayer()->getId(), $this->playerId2);
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id3)->getPlayer()->getId(), $this->playerId3);
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id4)->getPlayer()->getId(), $this->playerId4);


        //Check matches
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id1)->getMatch()->getId(), $this->matchId1);
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id2)->getMatch()->getId(), $this->matchId2);
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id3)->getMatch()->getId(), $this->matchId3);
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id4)->getMatch()->getId(), $this->matchId4);

        //Check time
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id1)->getTime(), $this->time1);
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id2)->getTime(), $this->time2);
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id3)->getTime(), $this->time3);
        $this->REQUIRE_EQUAL($this->db->getGoalById($this->id4)->getTime(), $this->time4);
    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->db->addGoal($this->playerId1, $this->time1, $this->matchId1), $this->id1);
        $this->REQUIRE_EQUAL($this->db->addGoal($this->playerId2, $this->time2, $this->matchId2), $this->id2);
        $this->REQUIRE_EQUAL($this->db->addGoal($this->playerId3, $this->time3, $this->matchId3), $this->id3);
        $this->REQUIRE_EQUAL($this->db->addGoal($this->playerId4, $this->time4, $this->matchId4), $this->id4);
    }

}

class BasicScoreTest extends UnitTest {

    private $db;

    private $id1;
    private $teamA1;
    private $teamB1;

    private $id2;
    private $teamA2;
    private $teamB2;

    private $id3;
    private $teamA3;
    private $teamB3;

    private $id4;
    private $teamA4;
    private $teamB4;


    public function __construct() {

        $this->teamA1 = 0;
        $this->teamB1 = 1;

        $this->teamA2 = 4;
        $this->teamB2 = 0;

        $this->teamA3 = 3;
        $this->teamB3 = 1;

        $this->teamA4 = 2;
        $this->teamB4 = 2;

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;

        $this->id1 = $this->db->addScore($this->teamA1, $this->teamB1);
        $this->id2 = $this->db->addScore($this->teamA2, $this->teamB2);
        $this->id3 = $this->db->addScore($this->teamA3, $this->teamB3);
        $this->id4 = $this->db->addScore($this->teamA4, $this->teamB4);

    }

    public function basicGetters() {

        //Check team A
        $this->REQUIRE_EQUAL($this->db->getScoreById($this->id1)->getScoreA(), $this->teamA1);
        $this->REQUIRE_EQUAL($this->db->getScoreById($this->id2)->getScoreA(), $this->teamA2);
        $this->REQUIRE_EQUAL($this->db->getScoreById($this->id3)->getScoreA(), $this->teamA3);
        $this->REQUIRE_EQUAL($this->db->getScoreById($this->id4)->getScoreA(), $this->teamA4);


        //Check team B
        $this->REQUIRE_EQUAL($this->db->getScoreById($this->id1)->getScoreB(), $this->teamB1);
        $this->REQUIRE_EQUAL($this->db->getScoreById($this->id2)->getScoreB(), $this->teamB2);
        $this->REQUIRE_EQUAL($this->db->getScoreById($this->id3)->getScoreB(), $this->teamB3);
        $this->REQUIRE_EQUAL($this->db->getScoreById($this->id4)->getScoreB(), $this->teamB4);

    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->db->addScore($this->teamA1, $this->teamB1), $this->id1);
        $this->REQUIRE_EQUAL($this->db->addScore($this->teamA2, $this->teamB2), $this->id2);
        $this->REQUIRE_EQUAL($this->db->addScore($this->teamA3, $this->teamB3), $this->id3);
        $this->REQUIRE_EQUAL($this->db->addScore($this->teamA4, $this->teamB4), $this->id4);
    }

}

class BasicPlaysInTest extends UnitTest {

    private $db;

    private $id1;
    private $teamId1;
    private $playerId1;

    private $id2;
    private $teamId2;
    private $playerId2;

    private $id3;
    private $teamId3;
    private $playerId3;

    private $id4;
    private $teamId4;
    private $playerId4;


    public function __construct() {

        $this->teamId1 = 1;
        $this->playerId1 = 1;

        $this->teamId2 = 1;
        $this->playerId2 = 2;

        $this->teamId3 = 3;
        $this->playerId3 = 1;

        $this->teamId4 = 2;
        $this->playerId4 = 2;

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;

        $this->id1 = $this->db->addPlayerToTeam($this->playerId1, $this->teamId1);
        $this->id2 = $this->db->addPlayerToTeam($this->playerId2, $this->teamId2);
        $this->id3 = $this->db->addPlayerToTeam($this->playerId3, $this->teamId3);
        $this->id4 = $this->db->addPlayerToTeam($this->playerId4, $this->teamId4);

    }

    public function basicGetters() {

        //Check players
        $this->REQUIRE_EQUAL($this->db->getPlaysInById($this->id1)->getplayer()->getId(), $this->playerId1);
        $this->REQUIRE_EQUAL($this->db->getPlaysInById($this->id2)->getplayer()->getId(), $this->playerId2);
        $this->REQUIRE_EQUAL($this->db->getPlaysInById($this->id3)->getplayer()->getId(), $this->playerId3);
        $this->REQUIRE_EQUAL($this->db->getPlaysInById($this->id4)->getplayer()->getId(), $this->playerId4);


        //Check teams
        $this->REQUIRE_EQUAL($this->db->getPlaysInById($this->id1)->getTeam()->getId(), $this->teamId1);
        $this->REQUIRE_EQUAL($this->db->getPlaysInById($this->id2)->getTeam()->getId(), $this->teamId2);
        $this->REQUIRE_EQUAL($this->db->getPlaysInById($this->id3)->getTeam()->getId(), $this->teamId3);
        $this->REQUIRE_EQUAL($this->db->getPlaysInById($this->id4)->getTeam()->getId(), $this->teamId4);

    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->db->addPlayerToTeam($this->playerId1, $this->teamId1), $this->id1);
        $this->REQUIRE_EQUAL($this->db->addPlayerToTeam($this->playerId2, $this->teamId2), $this->id2);
        $this->REQUIRE_EQUAL($this->db->addPlayerToTeam($this->playerId3, $this->teamId3), $this->id3);
        $this->REQUIRE_EQUAL($this->db->addPlayerToTeam($this->playerId4, $this->teamId4), $this->id4);
    }

}

class BasicPlaysMatchInTeamTest extends UnitTest {

    private $db;

    private $id1;
    private $teamId1;
    private $playerId1;
    private $matchId1;
    private $number1;

    private $id2;
    private $teamId2;
    private $playerId2;
    private $matchId2;
    private $number2;

    private $id3;
    private $teamId3;
    private $playerId3;
    private $matchId3;
    private $number3;

    private $id4;
    private $teamId4;
    private $playerId4;
    private $matchId4;
    private $number4;


    public function __construct() {

        $this->teamId1 = 1;
        $this->playerId1 = 1;
        $this->matchId1 = 1;
        $this->number1 = 11;

        $this->teamId2 = 1;
        $this->playerId2 = 2;
        $this->matchId2 = 2;
        $this->number2 = 12;

        $this->teamId3 = 3;
        $this->playerId3 = 1;
        $this->matchId3 = 3;
        $this->number3 = 4;

        $this->teamId4 = 2;
        $this->playerId4 = 2;
        $this->matchId4 = 1;
        $this->number4 = 1;

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;

        $this->id1 = $this->db->addPlayerToMatch($this->playerId1, $this->matchId1, $this->teamId1, $this->number1);
        $this->id2 = $this->db->addPlayerToMatch($this->playerId2, $this->matchId2, $this->teamId2, $this->number2);
        $this->id3 = $this->db->addPlayerToMatch($this->playerId3, $this->matchId3, $this->teamId3, $this->number3);
        $this->id4 = $this->db->addPlayerToMatch($this->playerId4, $this->matchId4, $this->teamId4, $this->number4);
    }

    public function basicGetters() {

        //Check players
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id1)->getplayer()->getId(), $this->playerId1);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id2)->getplayer()->getId(), $this->playerId2);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id3)->getplayer()->getId(), $this->playerId3);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id4)->getplayer()->getId(), $this->playerId4);


        //Check teams
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id1)->getTeam()->getId(), $this->teamId1);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id2)->getTeam()->getId(), $this->teamId2);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id3)->getTeam()->getId(), $this->teamId3);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id4)->getTeam()->getId(), $this->teamId4);


        //Check matches
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id1)->getMatch()->getId(), $this->matchId1);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id2)->getMatch()->getId(), $this->matchId2);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id3)->getMatch()->getId(), $this->matchId3);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id4)->getMatch()->getId(), $this->matchId4);

        //Check numbers
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id1)->getNumber(), $this->number1);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id2)->getNumber(), $this->number2);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id3)->getNumber(), $this->number3);
        $this->REQUIRE_EQUAL($this->db->getPlaysMatchInTeamById($this->id4)->getNumber(), $this->number4);
    }

    public function checkDuplicates() {

        $this->REQUIRE_EQUAL($this->db->addPlayerToMatch($this->playerId1, $this->matchId1, $this->teamId1, $this->number1), $this->id1);
        $this->REQUIRE_EQUAL($this->db->addPlayerToMatch($this->playerId2, $this->matchId2, $this->teamId2, $this->number2), $this->id2);
        $this->REQUIRE_EQUAL($this->db->addPlayerToMatch($this->playerId3, $this->matchId3, $this->teamId3, $this->number3), $this->id3);
        $this->REQUIRE_EQUAL($this->db->addPlayerToMatch($this->playerId4, $this->matchId4, $this->teamId4, $this->number4), $this->id4);
    }

}

class AdvancedCompetitionTest extends UnitTest {

    private $db;

    public function __construct() {

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;
    }

    public function getTournaments() {

        $this->REQUIRE_EQUAL(sizeof($this->db->getCompetitionById(1)->getTournaments()), 2);
        $this->REQUIRE_EQUAL(sizeof($this->db->getCompetitionById(2)->getTournaments()), 1);
        $this->REQUIRE_EQUAL(sizeof($this->db->getCompetitionById(3)->getTournaments()), 1);

    }
}

class AdvancedMatchTest extends UnitTest {

    private $db;

    public function __construct() {

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;
    }

    public function getTotalCards() {

        $this->REQUIRE_EQUAL($this->db->getMatchById(1)->getTotalCards(), 1);
        $this->REQUIRE_EQUAL($this->db->getMatchById(2)->getTotalCards(), 3);
        $this->REQUIRE_EQUAL($this->db->getMatchById(3)->getTotalCards(), 0);
        $this->REQUIRE_EQUAL($this->db->getMatchById(4)->getTotalCards(), 0);

    }

    public function getPlayers() {

        //Check team A
        $this->REQUIRE_EQUAL(sizeof($this->db->getMatchById(1)->getPlayersTeamA()), 1);
        $this->REQUIRE_EQUAL(sizeof($this->db->getMatchById(2)->getPlayersTeamA()), 0);
        $this->REQUIRE_EQUAL(sizeof($this->db->getMatchById(3)->getPlayersTeamA()), 0);
        $this->REQUIRE_EQUAL(sizeof($this->db->getMatchById(4)->getPlayersTeamA()), 0);

        //Check team B
        $this->REQUIRE_EQUAL(sizeof($this->db->getMatchById(1)->getPlayersTeamB()), 1);
        $this->REQUIRE_EQUAL(sizeof($this->db->getMatchById(2)->getPlayersTeamB()), 1);
        $this->REQUIRE_EQUAL(sizeof($this->db->getMatchById(3)->getPlayersTeamB()), 1);
        $this->REQUIRE_EQUAL(sizeof($this->db->getMatchById(4)->getPlayersTeamB()), 0);
    }
}

class AdvancedPlayerTest extends UnitTest {

    private $db;

    public function __construct() {

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;
    }

    public function getTotalCards() {

        $this->REQUIRE_EQUAL($this->db->getPlayerById(1)->getTotalNumberOfCards(), 2);
        $this->REQUIRE_EQUAL($this->db->getPlayerById(2)->getTotalNumberOfCards(), 1);
        $this->REQUIRE_EQUAL($this->db->getPlayerById(3)->getTotalNumberOfCards(), 1);

    }

    public function getTotalGoals() {

        $this->REQUIRE_EQUAL($this->db->getPlayerById(1)->getTotalNumberOfGoals(), 2);
        $this->REQUIRE_EQUAL($this->db->getPlayerById(2)->getTotalNumberOfGoals(), 1);
        $this->REQUIRE_EQUAL($this->db->getPlayerById(3)->getTotalNumberOfGoals(), 1);
    }

    public function getTotalMatches() {

        $this->REQUIRE_EQUAL($this->db->getPlayerById(1)->getTotalNumberOfMatches(), 2);
        $this->REQUIRE_EQUAL($this->db->getPlayerById(2)->getTotalNumberOfMatches(), 2);
        $this->REQUIRE_EQUAL($this->db->getPlayerById(3)->getTotalNumberOfMatches(), 0);
    }

    public function getTotalMatchesWon() {

        $this->REQUIRE_EQUAL($this->db->getPlayerById(1)->getTotalNumberOfWonMatches(), 1);
        $this->REQUIRE_EQUAL($this->db->getPlayerById(2)->getTotalNumberOfWonMatches(), 1);
        $this->REQUIRE_EQUAL($this->db->getPlayerById(3)->getTotalNumberOfWonMatches(), 0);
    }
}

class AdvancedTeamTest extends UnitTest {

    private $db;

    public function __construct() {

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;
    }

    public function getTotalMatches() {

        $this->REQUIRE_EQUAL($this->db->getTeamById(1)->getTotalPlayedMatches(), 3);
        $this->REQUIRE_EQUAL($this->db->getTeamById(2)->getTotalPlayedMatches(), 2);
        $this->REQUIRE_EQUAL($this->db->getTeamById(3)->getTotalPlayedMatches(), 3);
    }

    public function getTotalMatchesWon() {

        $this->REQUIRE_EQUAL($this->db->getTeamById(1)->getTotalWonMatches(), 0);
        $this->REQUIRE_EQUAL($this->db->getTeamById(2)->getTotalWonMatches(), 1);
        $this->REQUIRE_EQUAL($this->db->getTeamById(3)->getTotalWonMatches(), 2);
    }

    public function getPlayers() {

        $this->REQUIRE_EQUAL(count($this->db->getTeamById(1)->getPlayers()), 2);
        $this->REQUIRE_EQUAL(count($this->db->getTeamById(2)->getPlayers()), 1);
        $this->REQUIRE_EQUAL(count($this->db->getTeamById(3)->getPlayers()), 1);
    }
}

class AdvancedTournamentTest extends UnitTest {

    private $db;

    public function __construct() {

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;

    }

    public function getMatches() {

        echo totalMatches($this->db->getTournamentById(1)->getMatches(0));
        $this->REQUIRE_EQUAL(count($this->db->getTournamentById(1)->getMatches(0)), 3);
        $this->REQUIRE_EQUAL(count($this->db->getTournamentById(2)->getMatches(0)), 1);
        $this->REQUIRE_EQUAL(count($this->db->getTournamentById(3)->getMatches(0)), 0);
        $this->REQUIRE_EQUAL(count($this->db->getTournamentById(4)->getMatches(0)), 0);
    }

    public function totalMatches($matches) {
        echo "?";
        $total = 0;
        foreach($matches as $matchlist) {

            echo sizeof($matchlist);
            $total += sizeof($matchlist);
        }

        return $total;
    }
}

class AdvancedUserTest extends UnitTest {

    private $db;
    private $id1;
    private $username1;
    private $password1;
    private $hashedPassword1;
    private $salt1;
    private $emailAddress1;
    private $money1;
    private $id2;
    private $username2;
    private $password2;
    private $hashedPassword2;
    private $salt2;
    private $emailAddress2;
    private $money2;



    public function __construct() {
        $this->username1 = "testUser1";
        $this->password1 = "pass1";
        $this->salt1 = "1394275321a87b8d743";
        $this->hashedPassword1 = hash('sha256', $this->password1 . $this->salt1);
        $this->emailAddress1 = "testUser1@hotmail.com";
        $this->money1 = "100";

        $this->username2 = "testUser2";
        $this->password2 = "pass2";
        $this->salt2 = "9484065326ff2f987a9";
        $this->hashedPassword2 = hash('sha256', $this->password2 . $this->salt2);
        $this->emailAddress2 = "testUser2@hotmail.com";
        $this->money2 = "150";



        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = &$db;

        $this->id1 = $this->db->registerUser($this->username1,$this->salt1,$this->hashedPassword1,$this->emailAddress1);
        $this->id2 = $this->db->registerUser($this->username2,$this->salt2,$this->hashedPassword2,$this->emailAddress2);
        $this->db->setMoney($this->id1,$this->money1);
        $this->db->setMoney($this->id2,$this->money2);
        $this->db->setUserMail($this->id1,$this->emailAddress1);
        $this->db->setUserMail($this->id2,$this->emailAddress2);
        $this->db->setUserSalt($this->id1,$this->salt1);
        $this->db->setUserSalt($this->id2,$this->salt2);
        $this->db->setUserHash($this->id1,$this->hashedPassword1);
        $this->db->setUserHash($this->id2,$this->hashedPassword2);


    }

    public function basicGetters() {

        // Check usernames
        $this->REQUIRE_EQUAL($this->db->getUserName($this->id1), $this->username1);
        $this->REQUIRE_EQUAL($this->db->getUserName($this->id2), $this->username2);


        // Check userPasswordHash
        $this->REQUIRE_EQUAL($this->db->getUserPasswordHash($this->id1), $this->hashedPassword1);
        $this->REQUIRE_EQUAL($this->db->getUserPasswordHash($this->id2), $this->hashedPassword2);


        // Check userPasswordSalt
        $this->REQUIRE_EQUAL($this->db->getUserPasswordSalt($this->id1), $this->salt1);
        $this->REQUIRE_EQUAL($this->db->getUserPasswordSalt($this->id2), $this->salt2);

        // Check userMail
        $this->REQUIRE_EQUAL($this->db->getUserMail($this->id1), $this->emailAddress1);
        $this->REQUIRE_EQUAL($this->db->getUserMail($this->id2), $this->emailAddress2);

        // Check money
        $this->REQUIRE_EQUAL($this->db->getMoney($this->id1), $this->money1);
        $this->REQUIRE_EQUAL($this->db->getMoney($this->id2), $this->money2);

    }

    public function checkExists() {

        $this->REQUIRE_TRUE($this->db->doesUserNameExist($this->username1));
        $this->REQUIRE_TRUE($this->db->doesUserNameExist($this->username2));

        $this->REQUIRE_TRUE($this->db->doesUserExist($this->id1));
        $this->REQUIRE_TRUE($this->db->doesUserExist($this->id2));
    }

    public function basicSetters() {
        $this->emailAddress1 = "newmail1@hotmail.com";
        $this->db->setUserMail($this->id1,$this->emailAddress1);
        $this->REQUIRE_EQUAL($this->db->getUserMail($this->id1), $this->emailAddress1);

        $this->emailAddress2 = "newmail2@hotmail.com";
        $this->db->setUserMail($this->id2,$this->emailAddress2);
        $this->REQUIRE_EQUAL($this->db->getUserMail($this->id2), $this->emailAddress2);

        $this->salt1 = "30894753342be4c0951";
        $this->salt2 = "37822153342bef64a42";
        $this->password1 = "newPass1";
        $this->password2 = "newPass2";
        $this->hashedPassword1 = hash('sha256', $this->password1 . $this->salt1);
        $this->hashedPassword2 = hash('sha256', $this->password2 . $this->salt2);

        $this->db->setUserSalt($this->id1,$this->salt1);
        $this->REQUIRE_EQUAL($this->db->getUserPasswordSalt($this->id1),$this->salt1);
        $this->db->setUserSalt($this->id2,$this->salt2);
        $this->REQUIRE_EQUAL($this->db->getUserPasswordSalt($this->id2),$this->salt2);

        $this->db->setUserHash($this->id1,$this->hashedPassword1);
        $this->REQUIRE_EQUAL($this->db->getUserPasswordHash($this->id1),$this->hashedPassword1);
        $this->db->setUserHash($this->id2,$this->hashedPassword2);
        $this->REQUIRE_EQUAL($this->db->getUserPasswordHash($this->id2),$this->hashedPassword2);

        $this->money1 = "500";
        $this->money2 = "1000";

        $this->db->setMoney($this->id1,$this->money1);
        $this->REQUIRE_EQUAL($this->db->getMoney($this->id1),$this->money1);

        $this->db->setMoney($this->id2,$this->money2);
        $this->REQUIRE_EQUAL($this->db->getMoney($this->id2),$this->money2);

    }

}

class AdvancedBetTest extends UnitTest {
    private $id1;
    private $matchId1;
    private $score11;
    private $score12;
    private $userId1;
    private $amount1;
    private $id2;
    private $matchId2;
    private $score21;
    private $score22;
    private $userId2;
    private $amount2;
    private $db;

    public function __construct() {

        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;

        $this->matchId1 = "1";
        $this->score11 = "5";
        $this->score12 = "3";
        $this->userId1 ="1";
        $this->amount1 = "20";

        $this->matchId2 = "2";
        $this->score21 = "6";
        $this->score22 = "7";
        $this->userId2 ="2";
        $this->amount2 = "200";

        $this->db->addBet($this->matchId1,$this->score11,$this->score12,-1,-1,-1,$this->userId1,$this->amount1);
        $this->db->addBet($this->matchId2,$this->score21,$this->score22,-1,-1,-1,$this->userId2,$this->amount2);

        $betsUser1 = $this->db->getUserBets($this->userId1);
        $betsUser2 = $this->db->getUserBets($this->userId2);
        $this->id1 = $betsUser1[0];
        $this->id2 = $betsUser2[0];

    }

    public function getbets() {

            $this->REQUIRE_EQUAL($this->db->getMatchFromBet($this->id1), $this->matchId1);
            $this->REQUIRE_EQUAL($this->db->getMatchFromBet($this->id2), $this->matchId2);

            $this->REQUIRE_EQUAL($this->db->getScoreAFromBet($this->id1), $this->score11);
            $this->REQUIRE_EQUAL($this->db->getScoreBFromBet($this->id1), $this->score12);
            $this->REQUIRE_EQUAL($this->db->getScoreAFromBet($this->id2), $this->score21);
            $this->REQUIRE_EQUAL($this->db->getScoreBFromBet($this->id2), $this->score22);

            $this->REQUIRE_EQUAL($this->db->getMoneyFromBet($this->id1), $this->amount1);
            $this->REQUIRE_EQUAL($this->db->getMoneyFromBet($this->id2), $this->amount2);
    }
}


class AdvancedGroupTest extends UnitTest {
    private $name;
    private $owner;
    private $db;
    private $groupId;
    public function __construct() {
        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;
        $this->name = "TEST";
        $this->owner = 1;
        $this->groupId = $this->db->addGroup($this->name,$this->owner);
    }
    public function basicGetters(){
        $this->REQUIRE_TRUE($this->db->doesGroupNameExist($this->name));
        $this->REQUIRE_TRUE($this->db->doesGroupExist($this->groupId));
    }
    public function remove(){
        $this->db->removeGroup($this->groupId);
        $this->REQUIRE_FALSE($this->db->doesGroupExist($this->groupId));
    }
}

class AdvancedGroupMembershipTest extends UnitTest {
    private $name;
    private $ownerId;
    private $memberId;
    private $db;
    private $groupId;
    public function __construct() {
        $db = new \Database(DB_HOST, DB_USER, DB_PASS, "TestDB");
        $this->db = $db;
        $this->name = "TEST";
        $this->ownerId = 1;
        $this->memberId = 2;
        $this->groupId = $this->db->addGroup($this->name,$this->ownerId);
        $this->db->addGroupMembership($this->ownerId, $this->groupId);
        $this->db->acceptMembership($this->ownerId,$this->groupId);
    }
    public function testOwnerMember(){
        $this->REQUIRE_TRUE($this->db->isUserMemberOfGroup($this->ownerId,$this->groupId));
    }
    public function sendAnInvite(){
        $this->db->addGroupMembership($this->memberId, $this->groupId);
    }
    public function acceptInvite(){
        $this->REQUIRE_FALSE($this->db->isUserMemberOfGroup($this->memberId,$this->groupId));
        $this->db->acceptMembership($this->memberId,$this->groupId);
        $this->REQUIRE_TRUE($this->db->isUserMemberOfGroup($this->memberId,$this->groupId));
    }
    public function removeUser(){
        $this->db->removeUserFromGroup($this->memberId, $this->groupId);
        $this->REQUIRE_FALSE($this->db->isUserMemberOfGroup($this->memberId,$this->groupId));
    }
}

?>
