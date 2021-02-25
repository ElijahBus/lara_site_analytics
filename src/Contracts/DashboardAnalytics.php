<?php

namespace App\Contracts;

interface DashboardAnalytics
{
    /**
     * Get all authenticated visitors with their public information
     */
    public static function authVisitorsInfo();

    /**
     * Get the tolal registered murugo users
     *
     * @return mixed
     */
    public static function getTotalUsersAccount();

    /**
     * Get the nunmber of users that logged-in the site in a day
     *
     * @return integer
     */
    public static function getDailyLoggedInUsers();

    /**
     * Get the number of users that logged-in the site in a week
     *
     * @return integer
     */
    public static function getWeeklyLoggedInUsers();

    /**
     * Get the number of users that logged-in the site in a month
     *
     * @return integer
     */
    public static function getMonthlyLoggedInUsers();

    /**
     * Get the number of users that visited the website
     *
     * @return integer
     */
    public static function getWebVisitors();

    /**
     * Get the number of users who used the mobile app
     *
     * @return integer
     */
    public static function getMobileAppVisitors();

    /**
     * Get the numbers of authenticated users who visited the site in a week
     *
     * @return array
     */
    public static function getWeeklyAuthUsers();

    /**
     * Get the numbers of non-authenticated users who visited the site in a week
     *
     * @return array
     */
    public static function getWeeklyNonAuthUsers();

    /**
     * Get the number of authenticated users who visited the site in a month
     *
     * @return integer
     */
    public static function getMonthlyAuthUsers();

    /**
     * Get the number of non-authenticated users who visited the site in a month
     *
     * @return integer
     */
    public static function getMonthlyNonAuthUsers();

    /**
     * Get the number of active within 7 days from the current date
     *
     * @return array
     */
    public static function getWeeklyActiveUsers();

    /**
     * Get the number of active users each 30 days in weekly segment
     *
     * @return array
     */
    public static function getMonthlyActiveUsers();

    /**
     * Get the number of active users within three months from the current date
     *
     * @return array
     */
    public static function getThreeMonthsActiveUsers();

    /**
     * Get the number of active users within six months from the current date
     *
     * @return array
     */
    public static function getSixMonthsActiveUsers();

    /**
     * Get the number of active users within a year from the current date
     *
     * @return array
     */
    public static function getYearlyActiveUsers();

    /**
     * Get the number of new users visiting the site, or users with a new cookie set,
     * in weekly segement
     *
     * @return array
     */
    public static function getNewUsersRetention();

    /**
     * Get the number of returing users to the site, in weekly segment
     *
     * @return array
     */
    public static function getReturningUsersRetention();

    /**
     * Get the 10 mot active users
     *
     * @param $limit the number of users to get
     * @return mixed
     */
    public static function getMostActiveUsers($limit);

    /**
     * Get the time authenticated users spent on the site in a day
     *
     * @return mixed
     */
    public static function getAuthUsersTimeSpent();

    /**
     * Get the time non authenticated users spent on the site in a day
     *
     * @return mixed
     */
    public static function getNonAuthUsersTimeSpent();
}
