<?php

namespace App\Service;

use App\Entity\DiscountCoupons;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Class CouponManager
 * @package App\Service
 */
class CouponManager
{
    /**
     *  Constants
     */
    const DISABLE_ACTION_TYPE = "disable";
    const ENABLE_ACTION_TYPE = "enable";
    const DISABLE_COUPON_FLAG = 99;
    const ACTIVE_COUPON_FLAG = 100;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * CouponManager constructor.
     *
     * @param EntityManagerInterface $em
     * @param LoggerInterface $logger
     */
    public function __construct(EntityManagerInterface $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * Desc - Saves coupon details.
     *
     * @param array $data
     * @param string $requestType
     *
     * @return bool
     */
    public function saveCouponDetails(array $data, string $requestType): bool
    {
        if ($requestType == 'GENERATE') {
            $discountCoupon = new DiscountCoupons();
        } elseif ($requestType == 'UPDATE') {
            $discountCoupon = null;
        } else {
            // We shouldn't end here.
            return false;
        }
        // Setup details.
        $discountCoupon->setName($data['name']);
        $discountCoupon->setFlag(self::ACTIVE_COUPON_FLAG);
        $discountCoupon->setDescription($data['description']);
        $discountCoupon->setDiscountAmount($data['amount']);
        $discountCoupon->setStartDate(DateTime::createFromFormat('Y-m-d H:i:s', $data['start_date']));
        $discountCoupon->setExpiryDate(DateTime::createFromFormat('Y-m-d H:i:s', $data['end_date']));
        $discountCoupon->setMaxRedeem($data['max_redeem']);
        $discountCoupon->setMaxRedeemPerUser($data['max_redeem_per_user']);
        //Let's save the things in DB.
        try {
            $this->em->persist($discountCoupon);
            $this->em->flush();
        } catch (Exception $exception) {
            $this->logger->error('ERROR::COUPON_SERVICE - Error in saving coupon details. ' . $exception);

            return false;
        }

        return true;
    }

    /**
     * Desc - Update's coupon status.
     *
     * @param DiscountCoupons $discountCoupon
     * @param string $action
     *
     * @return bool
     */
    public function updateCouponStatus(DiscountCoupons $discountCoupon, string $action): bool
    {
        if (strtolower($action) == self::DISABLE_ACTION_TYPE) {
            $flag = self::DISABLE_COUPON_FLAG;
        } elseif(strtolower($action) == self::ENABLE_ACTION_TYPE) {
            $flag = self::ACTIVE_COUPON_FLAG;
        } else {
            // Can add more actions
            return false;
        }
        $discountCoupon->setFlag($flag);
        //Let's save the things in DB.
        try {
            $this->em->persist($discountCoupon);
            $this->em->flush();
        } catch (Exception $exception) {
            $this->logger->error('ERROR::COUPON_SERVICE - Error in disabling coupon. ' . $exception);

            return false;
        }

        return true;
    }
}