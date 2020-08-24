<?php

namespace App\Controller;

use App\Service\CouponManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     * @Route("/dashboard", name="home_p")
     *
     * @return Response
     */
    public function dashboardHome(Request $request): Response
    {
        $discountCoupons = array();
        $discountCouponRepo = $this->getDoctrine()->getRepository('Main:DiscountCoupons');
        $discountCoupons = $discountCouponRepo->findAll();

        return $this->render('discount_coupon_dashboard/index.html.twig', array('discount_coupons' => $discountCoupons));
    }

    /**
     * @Route("/add-coupon", name="_add_coupon")
     *
     * @return Response
     */
    public function addCoupon(): Response
    {
        return $this->render('discount_coupon_dashboard/add_coupon.html.twig');
    }

    /**
     * @Route("/update-coupon-status-action", name="_update_coupon_status_action")
     *
     * @param Request $request
     * @param CouponManager $couponManager
     *
     * @return Response
     */
    public function updateCouponStatusAction(Request $request, CouponManager $couponManager): Response
    {
        $content = $request->getContent();
        if (empty($content)) {
            return new Response(json_encode("Malformed Request. Empty Content."), 406);
        }
        $data = json_decode($content, true); // 2nd param to get as array.
        if (empty($data)) {
            return new Response(json_encode("Malformed Request. Empty data."), 406);
        }
        // Validate formData received.
        if (array_key_exists('id', $data) && !empty($data['id'])) {
            $couponId = $data['id'];
        } else {
            return new Response(json_encode("Malformed Request. Empty coupon id found."), 400);
        }
        if (array_key_exists('action', $data) && !empty($data['action'])) {
            $action = $data['action'];
        } else {
            return new Response(json_encode("Malformed Request. Empty action found."), 400);
        }
        // Check coupon id valid.
        $discountCoupon = $this->getDoctrine()->getRepository('Main:DiscountCoupons')->findOneById($couponId);
        if (empty($discountCoupon)) {
            return new Response(json_encode("Malformed Request. No coupon found."), 400);
        }
        // Update status.
        $success = $couponManager->updateCouponStatus($discountCoupon, $action);
        if ($success) {
            return new Response(json_encode("Request successfully completed."), 200);
        } else {
            return new Response(json_encode("Request not completed successfully."), 400);
        }
    }

    /**
     * @Route("/add-coupon-action", name="_add_coupon_action")
     *
     * @param Request $request
     * @param CouponManager $couponManager
     *
     * @return Response
     */
    public function submitCouponAction(Request $request, CouponManager $couponManager): Response
    {
        $inputData = array();
        $content = $request->getContent();
        if (empty($content)) {
            return new Response(json_encode("Malformed Request. Empty Content."), 406);
        }
        $formData = json_decode($content, true); // 2nd param to get as array.
        if (empty($formData)) {
            return new Response(json_encode("Malformed Request. Empty formData."), 406);
        }
        // Validate formData received.
        if (array_key_exists('name', $formData) && !empty($formData['name'])) {
            $inputData['name'] = $formData['name'];
        } else {
            return new Response(json_encode("Malformed Request. Empty coupon name found."), 400);
        }

        if (array_key_exists('description', $formData) && !empty($formData['description'])) {
            $inputData['description'] = $formData['description'];
        } else {
            return new Response(json_encode("Malformed Request. Empty description found."), 400);
        }

        if (array_key_exists('start_date', $formData) && !empty($formData['start_date'])) {
            $inputData['start_date'] = $formData['start_date'];
        } else {
            return new Response(json_encode("Malformed Request. Empty start date found."), 400);
        }

        if (array_key_exists('end_date', $formData) && !empty($formData['end_date'])) {
            $inputData['end_date'] = $formData['end_date'];
        } else {
            return new Response(json_encode("Malformed Request. Empty end date found."), 400);
        }

        if (array_key_exists('max_redeem', $formData) && !empty($formData['max_redeem'])) {
            $inputData['max_redeem'] = $formData['max_redeem'];
        } else {
            return new Response(json_encode("Malformed Request. Empty max redeem value found."), 400);
        }

        if (array_key_exists('max_redeem_per_user', $formData) && !empty($formData['max_redeem_per_user'])) {
            $inputData['max_redeem_per_user'] = $formData['max_redeem_per_user'];
        } else {
            return new Response(json_encode("Malformed Request. Empty max redeem per user value found."), 400);
        }

        if (array_key_exists('amount', $formData) && !empty($formData['amount'])) {
            $inputData['amount'] = $formData['amount'];
        } else {
            return new Response(json_encode("Malformed Request. Empty max redeem per user value found."), 400);
        }

        // Check max_redeem_per user adn max_redeem constraints
        if ($inputData['max_redeem_per_user'] > $inputData['max_redeem']) {
            return new Response(json_encode("Malformed Request. Found Max redeem per user greater than max redeem value."), 400);
        }

        // Check start & end date constraint
        if ($inputData['start_date'] > $inputData['end_date']) {
            return new Response(json_encode("Malformed Request. Found start date greater than end date value."), 400);
        }

        $saveDetailsSuccess = $couponManager->saveCouponDetails($inputData, 'GENERATE');
        if ($saveDetailsSuccess) {
            return new Response(json_encode("Request successfully completed."), 200);
        } else {
            return new Response(json_encode("Request not completed successfully."), 400);
        }
    }
}