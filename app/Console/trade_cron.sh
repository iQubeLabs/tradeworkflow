#!/usr/bin/env bash

#####################################################
# This is a cron job for handler for Tradeworkflow. #
# It uses the tradeworkflow shell and invokes them  #
# With cakephp cake script.                         #
#####################################################

#change to current working directory

# run updates on expiring formMs
./cake form_m_expiration

# run email notification on shipping dates
./cake shipping

# run updates on document tracking notifications
./cake document

# run updates on paar tracking notifications
./cake paar

# run updates on paar tracking notifications
./cake clearing

# run updates on shipment arrival notifications
./cake shipment_arrival

# run updates on document arrival notifications
./cake document_arrival