/**
 * 
 * Find more about the Spinning Wheel function at
 * http://cubiq.org/spinning-wheel-on-webkit-for-iphone-ipod-touch/11
 *
 * Copyright (c) 2009 Matteo Spinelli, http://cubiq.org/
 * Released under MIT license
 * http://cubiq.org/dropbox/mit-license.txt
 * 
 * Version 1.4.rcs.1 - Last updated: 2012.08.22
 *
 * Modified: 2012.08.21
 * Modified by: ronaldcs, http://www.dforge.net
 * Description: Added mouse events and option for page mask.
 *
 * Modified: 2012.08.22
 * Modified by: ronaldcs, http://www.dforge.net
 * Description: Added resetSlots and createSlots generic methods (will allow for dynamic update of the slots, e.g. perhaps to update the days
 * depending on the month selected).
 *
 * Modified: 2012.08.23
 * Modified by: ronaldcs, http://www.dforge.net
 * Description: Added ability to tap to a select. Added onchange event.
 *
 * Modified: 2012.09.24
 * Modified by: ronaldcs, http://www.dforge.net
 * Description: Issue with iOS5 firing both touchend and mouseup.
 *
 */

var SpinningWheel = {
	cellHeight: 44,
	friction: 0.003,
	slotData: [],
  scrolling: false,
  oldSlotValue: undefined,
  newSlotValue: undefined,

	/**
	 *
	 * Event handler
	 *
	 */

	handleEvent: function (e) {
		if (e.type == 'touchstart' || e.type == 'mousedown') { /* 2012.08.21 - Added mouse event */
			this.lockScreen(e);
			if (e.currentTarget.id == 'sw-cancel' || e.currentTarget.id == 'sw-done') {
				this.tapDown(e);
			} else if (e.currentTarget.id == 'sw-frame') {
        /***
         * 2012.08.23 - Added tap to select
         * TouchesEvent doesn't have offsetX or offsetY, so we'll use clientX (we don't have to use getBoundingClientRect for the X
         * since it's 100% width) and clientY - getBoundingClientRect().top. Seems to work. At least we're only using Webkit browsers!
         * See http://www.dforge.net/2012/08/23/find-an-elements-position-using-javascript/ for a detailed description.
         */
        this.whichPos = Math.floor((e.targetTouches ? e.targetTouches[0].clientY - e.target.getBoundingClientRect().top : e.offsetY) / this.cellHeight) - 2;         // You can only go up/down a max of two positions
        this.scrollStart(e);
        this.oldSlotValue = this.getSelectedValues().values[this.activeSlot]; /* 2012.08.23 - Added onchange event */
      }
		} else if (e.type == 'touchmove' || e.type == 'mousemove') { /* 2012.08.21 - Added mouse event */
			this.lockScreen(e);

			if (e.currentTarget.id == 'sw-cancel' || e.currentTarget.id == 'sw-done') {
				this.tapCancel(e);
			} else if (e.currentTarget.id == 'sw-frame') {
        this.scrolling = true; /* 2012.08.23 - Added tap to select - Needed to figure out if the sw-frame was in scroll mode. */
        this.scrollMove(e);
			}
		} else if (e.type == 'touchend' || e.type == 'mouseup') { /* 2012.08.21 - Added mouse event */
			if (e.currentTarget.id == 'sw-cancel' || e.currentTarget.id == 'sw-done' || e.currentTarget.id == 'sw-mask') {
				this.tapUp(e);
			} else if (e.currentTarget.id == 'sw-frame') {
        this.scrollEnd(e);
        if(this.scrolling) { /* 2012.08.23 - Added tap to select - If sw-frame is in scroll mode, skip tap to select. */
          this.slotEl[this.activeSlot].addEventListener('webkitTransitionEnd', this, false); /* 2012.08.23 - Added onchange event */
          this.scrolling = false;
        }
        else {
          var scrollTo = this.slotEl[this.activeSlot].slotYPosition - (this.whichPos * this.cellHeight); /* 2012.08.23 - Added tap to select */
          if (scrollTo <= 0 && scrollTo >= this.slotEl[this.activeSlot].slotMaxScroll) { /* 2012.08.23 - Added onchange event */
            this.slotEl[this.activeSlot].addEventListener('webkitTransitionEnd', this, false);
            this.scrollTo(this.activeSlot, scrollTo);
          };
        };
      }
		} else if (e.type == 'webkitTransitionEnd') {
//      console.log('webkitTransitionEnd');
      if (e.target.id == 'sw-wrapper') {
				this.destroy();
      } else if (e.target == this.slotEl[this.activeSlot]) { /* 2012.08.23 - Added onchange event */
        if(this.backWithinBoundaries(e)) {
          this.onChangeAction(e);
        };
      } else {
        this.backWithinBoundaries(e);
			}
		} else if (e.type == 'orientationchange') {
			this.onOrientationChange(e);
		} else if (e.type == 'scroll') {
			this.onScroll(e);
		}
	},


	/**
	 *
	 * Global events
	 *
	 */

  onChangeAction: function (e) { /* 2012.08.23 - Added onchange event */
    this.newSlotValue = this.getSelectedValues().values[this.activeSlot];
    if(this.oldSlotValue != this.newSlotValue) this.changeAction();
  },

	onOrientationChange: function (e) {
		window.scrollTo(0, 0);
		this.swWrapper.style.top = window.innerHeight + window.pageYOffset + 'px';
		this.calculateSlotsWidth();
	},
	
	onScroll: function (e) {
		this.swWrapper.style.top = window.innerHeight + window.pageYOffset + 'px';
	},

	lockScreen: function (e) {
		e.preventDefault();
		e.stopPropagation();
	},


	/**
	 *
	 * Initialization
	 *
	 */

	reset: function () {
		this.slotEl = [];

		this.activeSlot = null;

    this.swWrapper = undefined;
    this.swMask = undefined;
    this.swSlotWrapper = undefined;
		this.swSlots = undefined;
		this.swFrame = undefined;
	},

	calculateSlotsWidth: function () {
		var div = this.swSlots.getElementsByTagName('div');
		for (var i = 0; i < div.length; i += 1) {
			this.slotEl[i].slotWidth = div[i].offsetWidth;
		}
	},

	create: function () {
		var i, l, out, ul, div, maskDiv;

		this.reset();	// Initialize object variables

    // Create the Spinning Wheel main wrapper
    div = document.createElement('div');
    div.id = 'sw-wrapper';
    div.style.top = window.innerHeight + window.pageYOffset + 'px';		// Place the SW down the actual viewing screen
    div.style.webkitTransitionProperty = '-webkit-transform';
    div.innerHTML = '<div id="sw-header"><div id="sw-cancel">Cancel</' + 'div><div id="sw-done">Done</' + 'div></' + 'div><div id="sw-slots-wrapper"><div id="sw-slots"></' + 'div></' + 'div><div id="sw-frame"></' + 'div>';

    maskDiv = document.createElement('div'); /* 2012.08.21 - Mask implementation */
    maskDiv.id = 'sw-mask';
    maskDiv.style.width = this.getViewportSize().w + 'px';
    maskDiv.style.height = this.getViewportSize().h + 'px';

    document.body.appendChild(div);
    document.body.appendChild(maskDiv); /* 2012.08.21 - Mask implementation */

    this.swWrapper = div;										  			// The SW wrapper
    this.swMask = maskDiv;												  // The SW mask
    this.swSlotWrapper = document.getElementById('sw-slots-wrapper');		// Slots visible area
    this.swFrame = document.getElementById('sw-frame');						// The scrolling controller

    this.createSlots(); /* 2012.08.22 - createSlots implementation */

    // Global events
    document.addEventListener('touchstart', this, false);			// Prevent page scrolling
    document.addEventListener('touchmove', this, false);			// Prevent page scrolling
    document.addEventListener('mousedown', this, false);			// Prevent page scrolling /* 2012.08.21 - Added mouse event */
    document.addEventListener('mousemove', this, false);			// Prevent page scrolling /* 2012.08.21 - Added mouse event */
    window.addEventListener('orientationchange', this, true);		// Optimize SW on orientation change
		window.addEventListener('scroll', this, true);				// Reposition SW on page scroll

		// Cancel/Done buttons events
    document.getElementById('sw-cancel').addEventListener('touchstart', this, false);
    document.getElementById('sw-done').addEventListener('touchstart', this, false);
    document.getElementById('sw-cancel').addEventListener('mousedown', this, false); /* 2012.08.21 - Added mouse event */
    document.getElementById('sw-done').addEventListener('mousedown', this, false); /* 2012.08.21 - Added mouse event */

    // Add scrolling to the slots
    this.swFrame.addEventListener('touchstart', this, false);
    this.swFrame.addEventListener('mousedown', this, false); /* 2012.08.21 - Added mouse event */
  },

	open: function (p) {
    p = p || {};
		this.create();

		this.swWrapper.style.webkitTransitionTimingFunction = 'ease-out';
		this.swWrapper.style.webkitTransitionDuration = '400ms';
		this.swWrapper.style.webkitTransform = 'translate3d(0, -260px, 0)';
    if(p.showMask) this.swMask.style.display = 'block';  /* 2012.08.21 - Mask implementation */
    if(p.closeOnMaskTap) {  /* 2012.08.21 - Mask implementation */
      if('ontouchstart' in document.documentElement) { /* 2012.09.24 - Issue with iOS5 firing both touchend and mouseup */
        this.swMask.addEventListener('touchend', this, false);
      }
      else {
        this.swMask.addEventListener('mouseup', this, false);
      }
    }
	},
	
	
	/**
	 *
	 * Unload
	 *
	 */

	destroy: function () {
		this.swWrapper.removeEventListener('webkitTransitionEnd', this, false);

    this.swFrame.removeEventListener('touchstart', this, false);
    this.swFrame.removeEventListener('mousedown', this, false); /* 2012.08.21 - Remove mouse event */

    this.swMask.removeEventListener('touchend', this, false); /* 2012.08.21 - Mask implementation */
    this.swMask.removeEventListener('mouseup', this, false); /* 2012.08.21 - Mask implementation */

    document.getElementById('sw-cancel').removeEventListener('touchstart', this, false);
    document.getElementById('sw-done').removeEventListener('touchstart', this, false);
    document.getElementById('sw-cancel').removeEventListener('mousedown', this, false); /* 2012.08.21 - Remove mouse event */
    document.getElementById('sw-done').removeEventListener('mousedown', this, false); /* 2012.08.21 - Remove mouse event */

    document.removeEventListener('touchstart', this, false);
    document.removeEventListener('touchmove', this, false);
    document.removeEventListener('mousedown', this, false); /* 2012.08.21 - Remove mouse event */
    document.removeEventListener('mousemove', this, false); /* 2012.08.21 - Remove mouse event */
    window.removeEventListener('orientationchange', this, true);
		window.removeEventListener('scroll', this, true);

    for (l = 0; l < this.slotData.length; l += 1) {
      this.slotEl[l].removeEventListener('webkitTransitionEnd', this, false);	// Remove transition events from the slots
    };

    this.slotData = [];
    this.changeAction = function () { /* 2012.08.23 - Added onchange event */
      return false;
    };

    this.cancelAction = function () {
      return false;
    };

    this.cancelDone = function () {
			return true;
		};
		
		this.reset();

		document.body.removeChild(document.getElementById('sw-wrapper'));
    document.body.removeChild(document.getElementById('sw-mask'));
  },
	
	close: function () {
		this.swWrapper.style.webkitTransitionTimingFunction = 'ease-in';
		this.swWrapper.style.webkitTransitionDuration = '400ms';
		this.swWrapper.style.webkitTransform = 'translate3d(0, 0, 0)';
    this.swMask.style.display = 'none'; /* 2012.08.21 - Mask implementation */

    this.swWrapper.addEventListener('webkitTransitionEnd', this, false);
	},


	/**
	 *
	 * Generic methods
	 *
	 */

  resetSlots: function () { /* 2012.08.22 - createSlots implementation */
    for (l = 0; l < this.slotData.length; l += 1) {
      this.slotData[l].defaultValue = this.getSelectedValues().keys[l];
    };
    this.slotEl.length = 0;
    this.swSlots.innerHTML = "";
  },

  createSlots: function () { /* 2012.08.22 - createSlots implementation */
    this.swSlots = document.getElementById('sw-slots');						// Pseudo table element (inner wrapper)

    // Create HTML slot elements
    for (l = 0; l < this.slotData.length; l += 1) {
      // Create the slot
      ul = document.createElement('ul');
      out = '';
      for (i in this.slotData[l].values) {
        out += '<li>' + this.slotData[l].values[i] + '<' + '/li>';
      }
      ul.innerHTML = out;

      div = document.createElement('div');		// Create slot container
      div.className = this.slotData[l].style;		// Add styles to the container
      div.appendChild(ul);

      // Append the slot to the wrapper
      this.swSlots.appendChild(div);

      ul.slotPosition = l;			// Save the slot position inside the wrapper
      ul.slotYPosition = 0;
      ul.slotWidth = 0;
      ul.slotMaxScroll = this.swSlotWrapper.clientHeight - ul.clientHeight - 86;
      ul.style.webkitTransitionTimingFunction = 'cubic-bezier(0, 0, 0.2, 1)';		// Add default transition

      this.slotEl.push(ul);			// Save the slot for later use

      // Place the slot to its default position (if other than 0)
      if (this.slotData[l].defaultValue) {
        this.scrollToValue(l, this.slotData[l].defaultValue);
      }
    }

    this.calculateSlotsWidth();
  },

  addSlot: function (values, style, defaultValue) {
		if (!style) {
			style = '';
		}
		
		style = style.split(' ');

		for (var i = 0; i < style.length; i += 1) {
			style[i] = 'sw-' + style[i];
		}
		
		style = style.join(' ');

		var obj = { 'values': values, 'style': style, 'defaultValue': defaultValue };
		this.slotData.push(obj);
	},

	getSelectedValues: function () {
		var index, count,
		    i, l,
			keys = [], values = [];

		for (i in this.slotEl) {
			// Remove any residual animation
			this.slotEl[i].removeEventListener('webkitTransitionEnd', this, false);
			this.slotEl[i].style.webkitTransitionDuration = '0';

			if (this.slotEl[i].slotYPosition > 0) {
				this.setPosition(i, 0);
			} else if (this.slotEl[i].slotYPosition < this.slotEl[i].slotMaxScroll) {
				this.setPosition(i, this.slotEl[i].slotMaxScroll);
			}

			index = -Math.round(this.slotEl[i].slotYPosition / this.cellHeight);

			count = 0;
			for (l in this.slotData[i].values) {
				if (count == index) {
					keys.push(l);
					values.push(this.slotData[i].values[l]);
					break;
				}
				
				count += 1;
			}
		}

		return { 'keys': keys, 'values': values };
	},

  getViewportSize: function () { /* 2012.08.21 - Mask implementation */
    var viewportwidth, viewportheight;
    if (typeof window.innerWidth != 'undefined') {
      viewportwidth = window.innerWidth,
        viewportheight = window.innerHeight
    }
    else if (typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth != 'undefined' && document.documentElement.clientWidth != 0) {
      viewportwidth = document.documentElement.clientWidth,
        viewportheight = document.documentElement.clientHeight
    }
    else {
      viewportwidth = document.getElementsByTagName('body')[0].clientWidth,
        viewportheight = document.getElementsByTagName('body')[0].clientHeight
    };
    return {w: viewportwidth, h: viewportheight};
  },

  /**
	 *
	 * Rolling slots
	 *
	 */

	setPosition: function (slot, pos) {
            
		this.slotEl[slot].slotYPosition = pos;
		this.slotEl[slot].style.webkitTransform = 'translate3d(0, ' + pos + 'px, 0)';
  },
	
	scrollStart: function (e) {
    var event = (e.targetTouches ? e.targetTouches[0] : e); /* 2012.08.21 - Use touch event if it was invoked, otherwise assume a mouse event */
		// Find the clicked slot
		var xPos = event.clientX - this.swSlots.offsetLeft;	// Clicked position minus left offset (should be 11px)

		// Find tapped slot
		var slot = 0;
		for (var i = 0; i < this.slotEl.length; i += 1) {
			slot += this.slotEl[i].slotWidth;
			
			if (xPos < slot) {
				this.activeSlot = i;
				break;
			}
		}

		// If slot is readonly do nothing
		if (this.slotData[this.activeSlot].style.match('readonly')) {
      this.swFrame.removeEventListener('touchmove', this, false);
      this.swFrame.removeEventListener('touchend', this, false);
      this.swFrame.removeEventListener('mousemove', this, false); /* 2012.08.21 - Remove mouse event */
      this.swFrame.removeEventListener('mouseup', this, false); /* 2012.08.21 - Remove mouse event */
      return false;
		}

		this.slotEl[this.activeSlot].removeEventListener('webkitTransitionEnd', this, false);	// Remove transition event (if any)
		this.slotEl[this.activeSlot].style.webkitTransitionDuration = '0';		// Remove any residual transition
		
		// Stop and hold slot position
		var theTransform = window.getComputedStyle(this.slotEl[this.activeSlot]).webkitTransform;
		theTransform = new WebKitCSSMatrix(theTransform).m42;
		if (theTransform != this.slotEl[this.activeSlot].slotYPosition) {
			this.setPosition(this.activeSlot, theTransform);
		}
		
		this.startY = event.clientY;
		this.scrollStartY = this.slotEl[this.activeSlot].slotYPosition;
		this.scrollStartTime = e.timeStamp;

    this.swFrame.addEventListener('touchmove', this, false);
    this.swFrame.addEventListener('touchend', this, false);
    this.swFrame.addEventListener('mousemove', this, false); /* 2012.08.21 - Added mouse event */
    this.swFrame.addEventListener('mouseup', this, false); /* 2012.08.21 - Added mouse event */

    return true;
	},

	scrollMove: function (e) {
    var event = (e.targetTouches ? e.targetTouches[0] : e); /* 2012.08.21 - Use touch event if it was invoked, otherwise assume a mouse event */
    var topDelta = event.clientY - this.startY;

		if (this.slotEl[this.activeSlot].slotYPosition > 0 || this.slotEl[this.activeSlot].slotYPosition < this.slotEl[this.activeSlot].slotMaxScroll) {
			topDelta /= 2;
		}
		
		this.setPosition(this.activeSlot, this.slotEl[this.activeSlot].slotYPosition + topDelta);
		this.startY = event.clientY;

		// Prevent slingshot effect
		if (e.timeStamp - this.scrollStartTime > 80) {
			this.scrollStartY = this.slotEl[this.activeSlot].slotYPosition;
			this.scrollStartTime = e.timeStamp;
		}
	},
	
	scrollEnd: function (e) {
    this.swFrame.removeEventListener('touchmove', this, false);
    this.swFrame.removeEventListener('touchend', this, false);
    this.swFrame.removeEventListener('mousemove', this, false); /* 2012.08.21 - Remove mouse event */
    this.swFrame.removeEventListener('mouseup', this, false); /* 2012.08.21 - Remove mouse event */

    // If we are outside of the boundaries, let's go back to the sheepfold
		if (this.slotEl[this.activeSlot].slotYPosition > 0 || this.slotEl[this.activeSlot].slotYPosition < this.slotEl[this.activeSlot].slotMaxScroll) {
			this.scrollTo(this.activeSlot, this.slotEl[this.activeSlot].slotYPosition > 0 ? 0 : this.slotEl[this.activeSlot].slotMaxScroll);
			return false;
		}

    // Lame formula to calculate a fake deceleration
		var scrollDistance = this.slotEl[this.activeSlot].slotYPosition - this.scrollStartY;

    // The drag session was too short
		if (scrollDistance < this.cellHeight / 1.5 && scrollDistance > -this.cellHeight / 1.5) {
			if (this.slotEl[this.activeSlot].slotYPosition % this.cellHeight) {
				this.scrollTo(this.activeSlot, Math.round(this.slotEl[this.activeSlot].slotYPosition / this.cellHeight) * this.cellHeight, '250ms');
      }

      return false;
		}

    var scrollDuration = e.timeStamp - this.scrollStartTime;

		var newDuration = (2 * scrollDistance / scrollDuration) / this.friction;
		var newScrollDistance = (this.friction / 2) * (newDuration * newDuration);
		
		if (newDuration < 0) {
			newDuration = -newDuration;
			newScrollDistance = -newScrollDistance;
		}

		var newPosition = this.slotEl[this.activeSlot].slotYPosition + newScrollDistance;

		if (newPosition > 0) {
			// Prevent the slot to be dragged outside the visible area (top margin)
			newPosition /= 2;
			newDuration /= 3;

			if (newPosition > this.swSlotWrapper.clientHeight / 4) {
				newPosition = this.swSlotWrapper.clientHeight / 4;
			}
		} else if (newPosition < this.slotEl[this.activeSlot].slotMaxScroll) {
			// Prevent the slot to be dragged outside the visible area (bottom margin)
			newPosition = (newPosition - this.slotEl[this.activeSlot].slotMaxScroll) / 2 + this.slotEl[this.activeSlot].slotMaxScroll;
			newDuration /= 3;
			
			if (newPosition < this.slotEl[this.activeSlot].slotMaxScroll - this.swSlotWrapper.clientHeight / 4) {
				newPosition = this.slotEl[this.activeSlot].slotMaxScroll - this.swSlotWrapper.clientHeight / 4;
			}
		} else {
			newPosition = Math.round(newPosition / this.cellHeight) * this.cellHeight;
		}

		this.scrollTo(this.activeSlot, Math.round(newPosition), Math.round(newDuration) + 'ms');
 
		return true;
	},

	scrollTo: function (slotNum, dest, runtime) {
    this.slotEl[slotNum].style.webkitTransitionDuration = runtime ? runtime : '250ms';
		this.setPosition(slotNum, dest ? dest : 0);

		// If we are outside of the boundaries go back to the sheepfold
		if (this.slotEl[slotNum].slotYPosition > 0 || this.slotEl[slotNum].slotYPosition < this.slotEl[slotNum].slotMaxScroll) {
			this.slotEl[slotNum].addEventListener('webkitTransitionEnd', this, false);
		}
  },
	
	scrollToValue: function (slot, value) {
		var yPos, count, i;
alert(slot + " " + value);
		this.slotEl[slot].removeEventListener('webkitTransitionEnd', this, false);
		this.slotEl[slot].style.webkitTransitionDuration = '0';
		
		count = 0;
		for (i in this.slotData[slot].values) {
			if (i == value) {
				yPos = count * this.cellHeight;
				this.setPosition(slot, yPos);
				break;
			}
			
			count -= 1;
		}
	},
	
	backWithinBoundaries: function (e) {
    if (e.target.slotYPosition > 0 || e.target.slotYPosition < e.target.slotMaxScroll) { /* 2012.08.23 - Added onchange event */
      this.scrollTo(e.target.slotPosition, e.target.slotYPosition > 0 ? 0 : e.target.slotMaxScroll, '250ms');
      return false;
    };
    e.target.removeEventListener('webkitTransitionEnd', this, false);
    return true;
  },


	/**
	 *
	 * Buttons
	 *
	 */

	tapDown: function (e) {
    e.currentTarget.addEventListener('touchmove', this, false);
    e.currentTarget.addEventListener('mousemove', this, false); /* 2012.08.21 - Added mouse event */
    e.currentTarget.addEventListener('touchend', this, false);
    e.currentTarget.addEventListener('mouseup', this, false); /* 2012.08.21 - Added mouse event */
    e.currentTarget.className = 'sw-pressed';
	},

	tapCancel: function (e) {
    e.currentTarget.removeEventListener('touchmove', this, false);
    e.currentTarget.removeEventListener('mousemove', this, false); /* 2012.08.21 - Remove mouse event */
    e.currentTarget.removeEventListener('touchend', this, false);
    e.currentTarget.removeEventListener('mouseup', this, false); /* 2012.08.21 - Remove mouse event */
    e.currentTarget.className = '';
	},
	
	tapUp: function (e) {
		this.tapCancel(e);

		if (e.currentTarget.id == 'sw-cancel' || e.currentTarget.id == 'sw-mask') { /* 2012.08.21 - Mask implementation */
			this.cancelAction();
		} else {
			this.doneAction();
		}
		
		this.close();
	},

  setChangeAction: function (action) {
    this.changeAction = action;
  },

	setCancelAction: function (action) {
		this.cancelAction = action;
	},

	setDoneAction: function (action) {
		this.doneAction = action;
	},

  changeAction: function () {
    return false;
  },

	cancelAction: function () {
		return false;
	},

	cancelDone: function () {
		return true;
	}
};