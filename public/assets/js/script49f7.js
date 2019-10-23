!(function(t) {
    "use strict"
    var e = t(window),
        a = t("body"),
        o = t(document)

    function i() {
        return e.width()
    }
    "ontouchstart" in document.documentElement || a.addClass("no-touch")
    var n = i()
    e.on("resize", function() {
        n = i()
    })
    var s = t(".is-sticky"),
        l = t(".topbar"),
        r = t(".topbar-wrap")
    if (s.length > 0) {
        var c = s.offset()
        e.scroll(function() {
            var t = e.scrollTop(),
                a = l.height()
            t > c.top
                ? s.hasClass("has-fixed") || (s.addClass("has-fixed"), r.css("padding-top", a))
                : s.hasClass("has-fixed") && (s.removeClass("has-fixed"), r.css("padding-top", 0))
        })
    }
    var d = t("[data-percent]")
    d.length > 0 &&
        d.each(function() {
            var e = t(this),
                a = e.data("percent")
            e.css("width", a + "%")
        })
    var g = window.location.href,
        h = g.split("#"),
        f = t("a")
    f.length > 0 &&
        f.each(function() {
            g === this.href &&
                "" !== h[1] &&
                t(this)
                    .closest("li")
                    .addClass("active")
                    .parent()
                    .closest("li")
                    .addClass("active")
        })
    var p = t(".countdown-clock")
    p.length > 0 &&
        p.each(function() {
            var e = t(this),
                a = e.attr("data-date")
            e.countdown(a).on("update.countdown", function(e) {
                t(this).html(
                    e.strftime(
                        '<div><span class="countdown-time countdown-time-first">%D</span><span class="countdown-text">Day</span></div><div><span class="countdown-time">%H</span><span class="countdown-text">Hour</span></div><div><span class="countdown-time">%M</span><span class="countdown-text">Min</span></div><div><span class="countdown-time countdown-time-last">%S</span><span class="countdown-text">Sec</span></div>'
                    )
                )
            })
        })
    var v = t(".select")
    v.length > 0 &&
        v.each(function() {
            t(this).select2({
                theme: "flat"
            })
        })
    var u = t(".select-bordered")
    u.length > 0 &&
        u.each(function() {
            t(this).select2({
                theme: "flat bordered"
            })
        })
    var m = ".toggle-tigger"
    t(m).length > 0 &&
        o.on("click", m, function(e) {
            var a = t(this)
            t(m)
                .not(a)
                .removeClass("active"),
                t(".toggle-class")
                    .not(a.parent().children())
                    .removeClass("active"),
                a
                    .toggleClass("active")
                    .parent()
                    .find(".toggle-class")
                    .toggleClass("active"),
                e.preventDefault()
        }),
        o.on("click", "body", function(e) {
            var a = t(m),
                o = t(".toggle-class")
            o.is(e.target) ||
                0 !== o.has(e.target).length ||
                a.is(e.target) ||
                0 !== a.has(e.target).length ||
                (o.removeClass("active"), a.removeClass("active"))
        })
    var C = t(".toggle-nav"),
        b = t(".navbar")

    function w(t) {
        n < 991 ? t.delay(500).addClass("navbar-mobile") : t.delay(500).removeClass("navbar-mobile")
    }
    C.length > 0 &&
        C.on("click", function(t) {
            C.toggleClass("active"), b.toggleClass("active"), t.preventDefault()
        }),
        o.on("click", "body", function(t) {
            C.is(t.target) ||
                0 !== C.has(t.target).length ||
                b.is(t.target) ||
                0 !== b.has(t.target).length ||
                (C.removeClass("active"), b.removeClass("active"))
        }),
        w(b),
        e.on("resize", function() {
            w(b)
        })
    var y = t('[data-toggle="tooltip"]')
    y.length > 0 && y.tooltip()
    var k = t(".date-picker"),
        x = t(".date-picker-dob"),
        S = t(".time-picker")

    function T(e, a) {
        "success" === a
            ? t(e)
                  .parent()
                  .find(".copy-feedback")
                  .text("Copied to Clipboard")
                  .fadeIn()
                  .delay(1e3)
                  .fadeOut()
            : t(e)
                  .parent()
                  .find(".copy-feedback")
                  .text("Faild to Copy")
                  .fadeIn()
                  .delay(1e3)
                  .fadeOut()
    }
    k.length > 0 &&
        k.each(function() {
            t(this).datepicker({
                format: "mm/dd/yyyy",
                maxViewMode: 2,
                clearBtn: !0,
                autoclose: !0,
                todayHighlight: !0
            })
        }),
        x.length > 0 &&
            x.each(function() {
                t(this).datepicker({
                    format: "mm/dd/yyyy",
                    startView: 2,
                    maxViewMode: 2,
                    clearBtn: !0,
                    autoclose: !0
                })
            }),
        S.length > 0 &&
            S.each(function() {
                t(this)
                    .parent()
                    .addClass("has-timepicker"),
                    t(this).timepicker({
                        timeFormat: "HH:mm",
                        interval: 15
                    })
            }),
        new ClipboardJS(".copy-clipboard")
            .on("success", function(t) {
                T(t.trigger, "success"), t.clearSelection()
            })
            .on("error", function(t) {
                T(t.trigger, "fail")
            }),
        new ClipboardJS(".copy-clipboard-modal", {
            container: document.querySelector(".modal")
        })
            .on("success", function(t) {
                T(t.trigger, "success"), t.clearSelection()
            })
            .on("error", function(t) {
                T(t.trigger, "fail")
            })
    var L = t(".knob")
    L.length > 0 &&
        L.each(function() {
            t(this).knob({
                readOnly: !0,
                displayInput: !1
            })
        })
    var z = t(".switch-toggle"),
        D = t(".switch-toggle-link"),
        F = ".switch-content"

    function _(e, a, o) {
        e.length > 0 &&
            e.each(function() {
                "add" === o &&
                    t(this).data("switch") === a.data("switch") &&
                    t(this).addClass("link-disable"),
                    "remove" === o &&
                        t(this).data("switch") === a.data("switch") &&
                        t(this).removeClass("link-disable")
            })
    }
    z.length > 0 &&
        z.each(function() {
            t(this).on("change", function() {
                var e = t(this),
                    a = e.data("switch")
                e.is(":checked")
                    ? (t(F + "." + a)
                          .addClass("switch-active")
                          .slideDown(300),
                      _(D, t(this), "remove"))
                    : e.is(":checked") ||
                      (t(F + "." + a)
                          .removeClass("switch-active")
                          .slideUp(300),
                      _(D, t(this), "add"))
            }),
                t(this).is(":checked")
                    ? (t(F + "." + t(this).data("switch"))
                          .addClass("switch-active")
                          .slideDown(100),
                      _(D, t(this), "remove"))
                    : (t(F + "." + t(this).data("switch"))
                          .removeClass("switch-active")
                          .slideUp(100),
                      _(D, t(this), "add"))
        }),
        D.length > 0 &&
            D.each(function() {
                t(this).on("click", function(e) {
                    var a = t(this),
                        o = a.data("switch")
                    if (a.hasClass("link-disable")) return !1
                    t(F + "." + o)
                        .toggleClass("switch-active")
                        .slideToggle(300),
                        e.preventDefault()
                })
            })
    var M = t(".input-file")
    M.length > 0 &&
        M.each(function() {
            var e = t(this),
                a = t(this).next(),
                o = t(this)
                    .next()
                    .text()
            e.on("change", function() {
                var t = e.val()
                a.html(t), a.is(":empty") && a.html(o)
            })
        })
    var O = t(".upload-zone")
    O.length > 0 &&
        ((Dropzone.autoDiscover = !1),
        O.each(function() {
            t(this)
                .addClass("dropzone")
                .dropzone({
                    url: "/images"
                })
        }))
    var A = t(".image-popup")
    A.length > 0 &&
        A.magnificPopup({
            type: "image",
            preloader: !0,
            removalDelay: 400,
            mainClass: "mfp-fade"
        })
    var B = t(".dt-init")
    B.length > 0 &&
        B.each(function() {
            var e = t(this),
                a = e.data("items") ? e.data("items") : 5
            e.DataTable({
                ordering: !1,
                autoWidth: !1,
                dom:
                    '<"table-wrap"t><"row align-items-center"<"col-md-9"p><"col-md-3 text-left text-md-right"i>>',
                pageLength: a,
                bPaginate: t(".data-table tbody tr").length > a,
                iDisplayLength: a,
                language: {
                    search: "",
                    searchPlaceholder: "Type in to Search",
                    info: "_START_ -_END_ of _TOTAL_",
                    infoEmpty: "No records",
                    infoFiltered: "( Total _MAX_  )",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Prev"
                    }
                }
            })
        })
    var P = t(".dt-filter-init")
    if (P.length > 0) {
        var I = P.DataTable({
            ordering: !1,
            autoWidth: !1,
            dom:
                '<"row justify-content-between pdb-1x"<"col-9 col-sm-6 text-left"f><"col-3 text-right"<"data-table-filter relative d-inline-block">>><"table-wrap"t><"row align-items-center"<"col-md-9"p><"col-md-3 text-left text-md-right"i>>',
            pageLength: 6,
            bPaginate: t(".data-table tbody tr").length > 6,
            iDisplayLength: 6,
            language: {
                search: "",
                searchPlaceholder: "Type in to Search",
                info: "_START_ -_END_ of _TOTAL_",
                infoEmpty: "No records",
                infoFiltered: "( Total _MAX_  )",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Prev"
                }
            }
        })
        t(".data-filter").on("change", function() {
            var e = t(this).val(),
                a = t(this).parents(".data-table-filter"),
                o = a.data("filter-col") ? a.data("filter-col") : "dt-filter"
            I.columns("." + o)
                .search(e || "", !0, !1)
                .draw()
        })
    }
    if (t("#tknSale").length > 0) {
        var H = document.getElementById("tknSale").getContext("2d")
        new Chart(H, {
            type: "line",
            data: {
                labels: ["01 Oct", "02 Oct", "03 Oct", "04 Oct", "05 Oct", "06 Oct", "07 Oct"],
                datasets: [
                    {
                        label: "",
                        tension: 0.4,
                        backgroundColor: "transparent",
                        borderColor: "#2c80ff",
                        pointBorderColor: "#2c80ff",
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#2c80ff",
                        pointHoverBorderWidth: 2,
                        pointRadius: 6,
                        pointHitRadius: 6,
                        data: [110, 80, 125, 55, 95, 75, 90]
                    }
                ]
            },
            options: {
                legend: {
                    display: !1
                },
                maintainAspectRatio: !1,
                tooltips: {
                    callbacks: {
                        title: function(t, e) {
                            return "Date : " + e.labels[t[0].index]
                        },
                        label: function(t, e) {
                            return e.datasets[0].data[t.index] + " Tokens"
                        }
                    },
                    backgroundColor: "#eff6ff",
                    titleFontSize: 13,
                    titleFontColor: "#6783b8",
                    titleMarginBottom: 10,
                    bodyFontColor: "#9eaecf",
                    bodyFontSize: 14,
                    bodySpacing: 4,
                    yPadding: 15,
                    xPadding: 15,
                    footerMarginTop: 5,
                    displayColors: !1
                },
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: !0,
                                fontSize: 12,
                                fontColor: "#9eaecf"
                            },
                            gridLines: {
                                color: "#e5ecf8",
                                tickMarkLength: 0,
                                zeroLineColor: "#e5ecf8"
                            }
                        }
                    ],
                    xAxes: [
                        {
                            ticks: {
                                fontSize: 12,
                                fontColor: "#9eaecf",
                                source: "auto"
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength: 20,
                                zeroLineColor: "#e5ecf8"
                            }
                        }
                    ]
                }
            }
        })
    }
    window.pieColors = {
        pieColor1: "#00d285",
        pieColor2: "#ffc100"
    }
    if (t("#phaseStatus").length > 0) {
        var E = document.getElementById("phaseStatus").getContext("2d")
        new Chart(E, {
            type: "doughnut",
            data: {
                labels: ["Sold", "Unsold Tokens"],
                datasets: [
                    {
                        label: "7960000",
                        lineTension: 0,
                        backgroundColor: [window.pieColors.pieColor1, window.pieColors.pieColor2],
                        borderColor: "#fff",
                        borderWidth: 2,
                        hoverBorderColor: "#fff",
                        data: [15.74, 84.26]
                    }
                ]
            },
            options: {
                legend: {
                    display: !1,
                    labels: {
                        boxWidth: 10,
                        fontColor: "#000"
                    }
                },
                rotation: -1.6,
                cutoutPercentage: 80,
                maintainAspectRatio: !1,
                tooltips: {
                    callbacks: {
                        title: function(t, e) {
                            return e.labels[t[0].index]
                        },
                        label: function(t, e) {
                            return e.datasets[0].data[t.index] + " %"
                        }
                    },
                    backgroundColor: "#eff6ff",
                    titleFontSize: 13,
                    titleFontColor: "#6783b8",
                    titleMarginBottom: 10,
                    bodyFontColor: "#9eaecf",
                    bodyFontSize: 14,
                    bodySpacing: 4,
                    yPadding: 15,
                    xPadding: 15,
                    footerMarginTop: 5,
                    displayColors: !1
                }
            }
        })
    }
    if (t("#regStatistics").length > 0) {
        var N = document.getElementById("regStatistics").getContext("2d")
        new Chart(N, {
            type: "bar",
            data: {
                labels: ["S", "S", "M", "T", "W", "T", "F", "S", "S", "M", "T", "W", "T", "F", "S"],
                datasets: [
                    {
                        label: "",
                        lineTension: 0,
                        backgroundColor: "#2b56f5",
                        borderColor: "#2b56f5",
                        barThickness: 0.4,
                        data: [3, 9, 5, 7, 10, 6, 2, 3, 9, 5, 7, 10, 6, 2, 3]
                    }
                ]
            },
            options: {
                legend: {
                    display: !1
                },
                maintainAspectRatio: !1,
                tooltips: {
                    enabled: !1
                },
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: !0,
                                fontSize: 10,
                                fontColor: "#9eaecf"
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength: 0,
                                zeroLineColor: "transparent"
                            }
                        }
                    ],
                    xAxes: [
                        {
                            ticks: {
                                fontSize: 9,
                                fontColor: "#9eaecf",
                                source: "auto"
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength: 7,
                                zeroLineColor: "transparent"
                            }
                        }
                    ]
                }
            }
        })
    }
    t(".modal").on("shown.bs.modal", function() {
        a.hasClass("modal-open") || a.addClass("modal-open")
    })
    var R = t(".drop-toggle")
    R.length > 0 &&
        R.on("click", function(a) {
            e.width() < 991 &&
                (t(this)
                    .parent()
                    .children(".navbar-dropdown")
                    .slideToggle(400),
                t(this)
                    .parent()
                    .siblings()
                    .children(".navbar-dropdown")
                    .slideUp(400),
                t(this)
                    .parent()
                    .toggleClass("current"),
                t(this)
                    .parent()
                    .siblings()
                    .removeClass("current"),
                a.preventDefault())
        })
    var W = t(".form-validate")
    W.length > 0 &&
        W.each(function() {
            t(this).validate()
        })
    var V = t(".wizard-wrap").show()
    V.steps({
        headerTag: ".wizard-head",
        bodyTag: ".wizard-content",
        labels: {
            finish: "Submit",
            next: "Next",
            previous: "Prev",
            loading: "Loading ..."
        },
        onStepChanging: function(t, e, a) {
            return (
                e > a ||
                (e < a &&
                    (V.find(".body:eq(" + a + ") label.error").remove(),
                    V.find(".body:eq(" + a + ") .error").removeClass("error")),
                (V.validate().settings.ignore = ":disabled,:hidden"),
                V.valid())
            )
        },
        onFinishing: function(t, e) {
            return (V.validate().settings.ignore = ":disabled"), V.valid()
        },
        onFinished: function(t, e) {
            window.location.href = "thank-you.html"
        }
    }).validate({
        errorPlacement: function(t, e) {
            e.after(t)
        }
    })
    var j = t(".chat-wrap"),
        U = t(".chat-information-wrap"),
        X = t(".chat-contacts"),
        q = t(".show-information"),
        J = t(".chat-contact-trigger")
    q.length > 0 &&
        q.on("click", function(t) {
            q.toggleClass("active"),
                U.toggleClass("active"),
                X.toggleClass("short"),
                j.toggleClass("information-active"),
                t.preventDefault()
        }),
        J.length > 0 &&
            J.on("click", function(t) {
                X.toggleClass("active"), j.toggleClass("contact-active"), t.preventDefault()
            })
    var Z = t(".chat-messages-search"),
        Q = t(".show-search")
    Q.length > 0 &&
        Q.on("click", function(e) {
            t(this).toggleClass("active"), Z.toggleClass("active"), e.preventDefault()
        }),
        o.on("click", "body", function(t) {
            J.is(t.target) ||
                0 !== J.has(t.target).length ||
                X.is(t.target) ||
                0 !== X.has(t.target).length ||
                (X.removeClass("active"), j.removeClass("contact-active")),
                !q.is(t.target) &&
                    0 === q.has(t.target).length &&
                    !U.is(t.target) &&
                    0 === U.has(t.target).length &&
                    e.width() < 992 &&
                    (q.removeClass("active"),
                    U.removeClass("active"),
                    X.removeClass("short"),
                    j.removeClass("information-active")),
                Q.is(t.target) ||
                    0 !== Q.has(t.target).length ||
                    Z.is(t.target) ||
                    0 !== Z.has(t.target).length ||
                    (Q.removeClass("active"), Z.removeClass("active"))
        })
    var G = t(".load-timeline")
    G.length > 0 &&
        G.on("click", function(e) {
            e.preventDefault()
            var a = t(this),
                o = a.data("target"),
                i = a.data("show") ? a.data("show") : 5
            if (o) {
                var n = t("#" + o).find(".hidden")
                n.length > 0 &&
                    (n.slice(0, i).removeClass("hidden"),
                    n.length <= i && (a.parent().fadeOut("slow"), t("#" + o).addClass("loaded")))
            }
        }),
        t(".demo-toggle").on("click", function() {
            t(".demo-content").slideToggle("slow")
        })
    var K = t(".color-trigger")
    K.length > 0 &&
        K.on("click", function() {
            var e = t(this).attr("title")
            return (
                t("body").fadeOut(function() {
                    t("#layoutstyle").attr("href", "assets/css/" + e + ".css"),
                        t(this)
                            .delay(150)
                            .fadeIn()
                }),
                !1
            )
        })

    // video starts here

     var vid = $("#myvid")

     //default video source
     $(vid).attr("src", $("a.link:first").attr("href"))

     // addClass playing to first video link
     $("a.link:first").addClass("playing")

     $("a.link").on("click", function(event) {
         // prevent link default
         event.preventDefault()

         // change video source
         $(vid).attr("src", $(this).attr("href"))

         // remouve class playing from unplayed video href
         $(".vids a").removeClass("playing")

         // add class playing to video href
         $(this).addClass("playing")

         // add class paused to give the play/pause button the right look
         $(".btnPlay").addClass("paused")

         // play the video
         vid[0].play()

         // adjust prev button state
         if ($("a.link:first").hasClass("playing")) {
             $(".prevvid").addClass("disabled")
         } else {
             $(".prevvid").removeClass("disabled")
         }

         // adjust next button state
         if ($("a.link:last").hasClass("playing")) {
             $(".nextvid").addClass("disabled")
         } else {
             $(".nextvid").removeClass("disabled")
         }
     })

     //VIDEO EVENTS
     //video canplay event
     vid.on("canplay", function() {
         $(".loading").fadeOut(100)
     })

     //video canplaythrough event
     //solve Chrome cache issue
     var completeloaded = false
     vid.on("canplaythrough", function() {
         completeloaded = true
     })

     //video ended event
     vid.on("ended", function() {
         $(".btnPlay").removeClass("paused")
         vid[0].pause()
     })

     //video seeking event
     vid.on("seeking", function() {
         //if video fully loaded, ignore loading screen
         if (!completeloaded) {
             $(".loading").fadeIn(200)
         }
     })

     //video seeked event
     vid.on("seeked", function() {})

     //video waiting for more data event
     vid.on("waiting", function() {
         $(".loading").fadeIn(200)
     })

     /*controllers*/
     //before everything get started
     vid.on("loadedmetadata", function() {
         //set video properties
         $(".current").text(timeFormat(0))
         $(".duration").text(timeFormat(vid[0].duration))
         if (vid[0].muted) {
             updateVolume(0, 0)
         } else {
             updateVolume(0, 0.7)
         }
     })

     //display video buffering bar
     var startBuffer = function() {
         var currentBuffer = vid[0].buffered.end(0)
         var maxduration = vid[0].duration
         var perc = (100 * currentBuffer) / maxduration
         $(".bufferBar").css("width", perc + "%")

         if (currentBuffer < maxduration) {
             setTimeout(startBuffer, 500)
         }
     }

     //display current video play time
     vid.on("timeupdate", function() {
         var currentPos = vid[0].currentTime
         var maxduration = vid[0].duration
         var perc = (100 * currentPos) / maxduration
         $(".timeBar").css("width", perc + "%")
         $(".current").text(timeFormat(currentPos))
     })

     //CONTROLS EVENTS
     //video screen and play button clicked
     vid.on("click", function() {
         playpause()
     })
     $(".btnPlay").on("click", function() {
         playpause()
     })
     var playpause = function() {
         if (vid[0].paused || vid[0].ended) {
             $(".btnPlay").addClass("paused")
             vid[0].play()
         } else {
             $(".btnPlay").removeClass("paused")
             vid[0].pause()
         }
     }

     //VIDEO PROGRESS BAR
     //when video timebar clicked
     var timeDrag = false /* check for drag event */
     $(".progress").on("mousedown", function(e) {
         timeDrag = true
         updatebar(e.pageX)
     })
     $(document).on("mouseup", function(e) {
         if (timeDrag) {
             timeDrag = false
             updatebar(e.pageX)
         }
     })
     $(document).on("mousemove", function(e) {
         if (timeDrag) {
             updatebar(e.pageX)
         }
     })
     var updatebar = function(x) {
         var progress = $(".progress")

         //calculate drag position
         //and update video currenttime
         //as well as progress bar
         var maxduration = vid[0].duration
         var position = x - progress.offset().left
         var percentage = (100 * position) / progress.width()
         if (percentage > 100) {
             percentage = 100
         }
         if (percentage < 0) {
             percentage = 0
         }
         $(".timeBar").css("width", percentage + "%")
         vid[0].currentTime = (maxduration * percentage) / 100
     }
     //sound button clicked
     $(".sound").click(function() {
         vid[0].muted = !vid[0].muted
         $(this).toggleClass("muted")
         if (vid[0].muted) {
             $(".volumeBar").css("width", 0)
         } else {
             $(".volumeBar").css("width", vid[0].volume * 100 + "%")
         }
     })

     //VOLUME BAR
     //volume bar event
     var volumeDrag = false
     $(".volume").on("mousedown", function(e) {
         volumeDrag = true
         vid[0].muted = false
         $(".sound").removeClass("muted")
         updateVolume(e.pageX)
     })
     $(document).on("mouseup", function(e) {
         if (volumeDrag) {
             volumeDrag = false
             updateVolume(e.pageX)
         }
     })
     $(document).on("mousemove", function(e) {
         if (volumeDrag) {
             updateVolume(e.pageX)
         }
     })
     var updateVolume = function(x, vol) {
         var volume = $(".volume")
         var percentage
         //if only volume have specificed
         //then direct update volume
         if (vol) {
             percentage = vol * 100
         } else {
             var position = x - volume.offset().left
             percentage = (100 * position) / volume.width()
         }

         if (percentage > 100) {
             percentage = 100
         }
         if (percentage < 0) {
             percentage = 0
         }

         //update volume bar and video volume
         $(".volumeBar").css("width", percentage + "%")
         vid[0].volume = percentage / 100

         //change sound icon based on volume
         if (vid[0].volume == 0) {
             $(".sound")
                 .removeClass("sound2")
                 .addClass("muted")
         } else if (vid[0].volume > 0.5) {
             $(".sound")
                 .removeClass("muted")
                 .addClass("sound2")
         } else {
             $(".sound")
                 .removeClass("muted")
                 .removeClass("sound2")
         }
     }

     //speed text clicked
     $(".spdx50").on("click", function() {
         fastfowrd(this, 1.5)
     })
     $(".spdx25").on("click", function() {
         fastfowrd(this, 1.25)
     })
     $(".spdx1").on("click", function() {
         fastfowrd(this, 1)
     })
     $(".spdx050").on("click", function() {
         fastfowrd(this, 0.5)
     })
     var fastfowrd = function(obj, spd) {
         $(".speedcnt li").removeClass("selected")
         $(obj).addClass("selected")
         vid[0].playbackRate = spd
         vid[0].play()
         $("ul.speedcnt").fadeOut("fast")
         $(".btnPlay").addClass("paused")
     }
     $(".btnspeed").click(function() {
         $("ul.speedcnt").slideToggle(100)
     })

     //fullscreen button clicked
     $(".btnFS").on("click", function() {
         if ($.isFunction(vid[0].webkitEnterFullscreen)) {
             vid[0].webkitEnterFullscreen()
         } else if ($.isFunction(vid[0].mozRequestFullScreen)) {
             vid[0].mozRequestFullScreen()
         } else {
             alert("Your browsers doesn't support fullscreen")
         }
     })

     //light bulb button clicked
     $(".btnLight").click(function() {
         $(this).toggleClass("lighton")

         //if lightoff, create an overlay
         if (!$(this).hasClass("lighton")) {
             $("body").append('<div class="overlay"></div>')
             $(".overlay").css({
                 position: "absolute",
                 width: 100 + "%",
                 height: $(document).height(),
                 background: "#000",
                 opacity: 0.9,
                 top: 0,
                 left: 0,
                 "z-index": 999
             })
             $(".vidcontainer").css({
                 "z-index": 1000
             })
         }
         //if lighton, remove overlay
         else {
             $(".overlay").remove()
         }
     })

     //hide pause button if video onplaying
     //if (vid.onplaying = true) { $('.btnPlay').addClass('paused'); };

     //previous video button
     $(".prevvid").click(function() {
         $(vid).attr(
             "src",
             $(".playing")
                 .prev()
                 .attr("href")
         )
         vid[0].play()
         $(".playing")
             .prev()
             .addClass("playing")
         $(".playing:last").removeClass("playing")
         $(".btnPlay").addClass("paused")
         $(".nextvid").removeClass("disabled")
         if ($("a.link:first").hasClass("playing")) {
             $(this).addClass("disabled")
         } else {
             $(this).removeClass("disabled")
         }
     })

     //previous video button
     $(".nextvid").click(function() {
         $(vid).attr(
             "src",
             $(".playing")
                 .next()
                 .attr("href")
         )
         vid[0].play()
         $(".playing")
             .next()
             .addClass("playing")
         $(".playing:first").removeClass("playing")
         $(".btnPlay").addClass("paused")
         $(".prevvid").removeClass("disabled")
         if ($("a.link:last").hasClass("playing")) {
             $(this).addClass("disabled")
         } else {
             $(this).removeClass("disabled")
         }
     })

     //Time format converter - 00:00
     var timeFormat = function(seconds) {
         var m =
             Math.floor(seconds / 60) < 10
                 ? "0" + Math.floor(seconds / 60)
                 : Math.floor(seconds / 60)
         var s =
             Math.floor(seconds - m * 60) < 10
                 ? "0" + Math.floor(seconds - m * 60)
                 : Math.floor(seconds - m * 60)
         return m + ":" + s
     }
     $(".closeme , .bigplay").click(function() {
         $("this,.ads,.bigplay").fadeOut(200)
         vid[0].play()
         $(".btnPlay").addClass("paused")
     })

})(jQuery)
