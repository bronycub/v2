#!/bin/bash
DATA=$(curl https://gitlab.com/mdevlamynck/sugarcub/milestones/3)
clear
echo $DATA | cut -c13957-13959
