#<?= $ID ?> .row-assets {
  border-top: 1px solid #acacac;
}
#<?= $ID ?> .row-assets > div {
  text-align: center;
}
#<?= $ID ?> .row-assets > div > div {
  min-width: 150px;
  text-align: left;
  display: inline-block;
}
#<?= $ID ?> .row-assets > div:before {
  content: '';
  top: 0;
  right: 26px;
  left: 26px;
  height: 1px;
  position: absolute;
  background-color: #acacac;
}
#<?= $ID ?> .row-assets > div:nth-child(1):before {
  display: none;
}
#<?= $ID ?> .row-assets > div:after {
  content: '';
  right: 0;
  top: 24px;
  width: 1px;
  height: 30px;
  position: absolute;
  background-color: #acacac;
}
#<?= $ID ?> .row-assets > div:last-of-type:after {
  display: none;
}
#<?= $ID ?> .row-assets img {
  float: left;
  width: 35px;
  margin-right: 7px;
  padding-top: 21px;
}
#<?= $ID ?> .row-assets a {
  font-size: 12px;
  line-height: 80px;
  color:#000!important;
  text-decoration: none;
  font-family: agMedium, Arial, sans-serif;
}

@media only screen and (min-width:768px) {
  #<?= $ID ?> .row-assets > div:nth-child(1):before,
  #<?= $ID ?> .row-assets > div:nth-child(2):before {
    display: none;
  }
}
@media only screen and (min-width:992px) {
  #<?= $ID ?> .row-assets > div:before {
    display: none;
  }
}
@media only screen and (max-width:992px) {
  #<?= $ID ?> .row-assets > div:nth-child(2n):after {
    display: none;
  }
}
@media only screen and (max-width:767px) {
  #<?= $ID ?> .row-assets > div:after {
    display: none;
  }
  #<?= $ID ?> .row-assets > div:before {
    left: 0; right: 0;
  }
}
