<?php

namespace ATF\Review\Plugin;

class Review
{


    public function afterValidate(\Magento\Review\Model\Review $subject, $result)
    {
        if($result)
        {
            $name = $subject->getNickname();
            $pattern = '[\w\-]';
            $hasDash = preg_match($pattern, $name);

            if ($hasDash) {
                return [__('User Name must not contain any dashes')];
            }
        }

        return $result;
    }

}
