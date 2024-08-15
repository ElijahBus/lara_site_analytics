<?php

namespace App\Contracts;

interface AnalyticsInterface
{
    /**
     * Get all authenticated visitors with their public information
     */
    public static function authVisitorsInfo();

    /**
     * Get the total registered users
     *
     * @return mixed
     */
    public static function getTotalUsersAccount();

    /**
     * Get the number of users that logged-in the site in a day
     *
     * @return integer
     */
    public static function getDailyLoggedInUsers(): int;

    /**
     * Get the number of users that logged-in the site in a week
     *
     * @return integer
     */
    public static function getWeeklyLoggedInUsers(): int;

    /**
     * Get the number of users that logged-in the site in a month
     *
     * @return integer
     */
    public static function getMonthlyLoggedInUsers(): int;

    /**
     * Get the number of users that visited the website
     *
     * @return integer
     */
    public static function getWebVisitors(): int;

    /**
     * Get the number of users who used the mobile app
     *
     * @return integer
     */
    public static function getMobileAppVisitors(): int;

    /**
     * Get the numbers of authenticated users who visited the site in a week
     *
     * @return array
     */
    public static function getWeeklyAuthUsers(): array;

    /**
     * Get the numbers of non-authenticated users who visited the site in a week
     *
     * @return array
     */
    public static function getWeeklyNonAuthUsers(): array;

    /**
     * Get the number of authenticated users who visited the site in a month
     *
     * @return integer
     */
    public static function getMonthlyAuthUsers(): int;

    /**
     * Get the number of non-authenticated users who visited the site in a month
     *
     * @return integer
     */
    public static function getMonthlyNonAuthUsers(): int;

    /**
     * Get the number of active within 7 days from the current date
     *
     * @return array
     */
    public static function getWeeklyActiveUsers(): array;

    /**
     * Get the number of active users each 30 days in weekly segment
     *
     * @return array
     */
    public static function getMonthlyActiveUsers(): array;

    /**
     * Get the number of active users within three months from the current date
     *
     * @return array
     */
    public static function getThreeMonthsActiveUsers(): array;

    /**
     * Get the number of active users within six months from the current date
     *
     * @return array
     */
    public static function getSixMonthsActiveUsers(): array;

    /**
     * Get the number of active users within a year from the current date
     *
     * @return array
     */
    public static function getYearlyActiveUsers(): array;

    /**
     * Get the number of new users visiting the site, or users with a new cookie set,
     * in weekly segement
     *
     * @return array
     */
    public static function getNewUsersRetention(): array;

    /**
     * Get the number of returing users to the site, in weekly segment
     *
     * @return array
     */
    public static function getReturningUsersRetention(): array;

    /**
     * Get the 10 mot active users
     *
     * @param $limit, the number of users to get
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
     * Get the time non-authenticated users spent on the site in a day
     *
     * @return mixed
     */
    public static function getNonAuthUsersTimeSpent();
}
