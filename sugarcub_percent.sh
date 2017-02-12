#!/bin/bash
DATA=$(curl https://gitlab.com/mdevlamynck/sugarcub/milestones/3)
clear
echo $DATA | cut -c13910-13912
