window.VLibras = function (t) {
    function e(e) {
        for (var n, o, r = e[0], a = e[1], s = 0, l = []; s < r.length; s++) o = r[s], Object.prototype.hasOwnProperty.call(i, o) && i[o] && l.push(i[o][0]), i[o] = 0;
        for (n in a) Object.prototype.hasOwnProperty.call(a, n) && (t[n] = a[n]);
        for (c && c(e); l.length;) l.shift()()
    }
    var n = {},
        i = {
            1: 0
        };

    function o(e) {
        if (n[e]) return n[e].exports;
        var i = n[e] = {
            i: e,
            l: !1,
            exports: {}
        };
        return t[e].call(i.exports, i, i.exports, o), i.l = !0, i.exports
    }
    o.e = function (t) {
        var e = [],
            n = i[t];
        if (0 !== n)
            if (n) e.push(n[2]);
            else {
                var r = new Promise((function (e, o) {
                    n = i[t] = [e, o]
                }));
                e.push(n[2] = r);
                var a, s = document.createElement("script");
                s.charset = "utf-8", s.timeout = 120, o.nc && s.setAttribute("nonce", o.nc), s.src = function (t) {
                    return o.p + "" + t + ".vlibras-plugin.js"
                }(t);
                var c = new Error;
                a = function (e) {
                    s.onerror = s.onload = null, clearTimeout(l);
                    var n = i[t];
                    if (0 !== n) {
                        if (n) {
                            var o = e && ("load" === e.type ? "missing" : e.type),
                                r = e && e.target && e.target.src;
                            c.message = "Loading chunk " + t + " failed.\n(" + o + ": " + r + ")", c.name = "ChunkLoadError", c.type = o, c.request = r, n[1](c)
                        }
                        i[t] = void 0
                    }
                };
                var l = setTimeout((function () {
                    a({
                        type: "timeout",
                        target: s
                    })
                }), 12e4);
                s.onerror = s.onload = a, document.head.appendChild(s)
            } return Promise.all(e)
    }, o.m = t, o.c = n, o.d = function (t, e, n) {
        o.o(t, e) || Object.defineProperty(t, e, {
            enumerable: !0,
            get: n
        })
    }, o.r = function (t) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(t, "__esModule", {
            value: !0
        })
    }, o.t = function (t, e) {
        if (1 & e && (t = o(t)), 8 & e) return t;
        if (4 & e && "object" == typeof t && t && t.__esModule) return t;
        var n = Object.create(null);
        if (o.r(n), Object.defineProperty(n, "default", {
                enumerable: !0,
                value: t
            }), 2 & e && "string" != typeof t)
            for (var i in t) o.d(n, i, function (e) {
                return t[e]
            }.bind(null, i));
        return n
    }, o.n = function (t) {
        var e = t && t.__esModule ? function () {
            return t.default
        } : function () {
            return t
        };
        return o.d(e, "a", e), e
    }, o.o = function (t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }, o.p = "https://www.vlibras.gov.br/app/", o.oe = function (t) {
        throw t
    };
    var r = window.webpackJsonpVLibras = window.webpackJsonpVLibras || [],
        a = r.push.bind(r);
    r.push = e, r = r.slice();
    for (var s = 0; s < r.length; s++) e(r[s]);
    var c = a;
    return o(o.s = 4)
}([function (t, e, n) {
    "use strict";
    var i, o = function () {
            return void 0 === i && (i = Boolean(window && document && document.all && !window.atob)), i
        },
        r = function () {
            var t = {};
            return function (e) {
                if (void 0 === t[e]) {
                    var n = document.querySelector(e);
                    if (window.HTMLIFrameElement && n instanceof window.HTMLIFrameElement) try {
                        n = n.contentDocument.head
                    } catch (t) {
                        n = null
                    }
                    t[e] = n
                }
                return t[e]
            }
        }(),
        a = [];

    function s(t) {
        for (var e = -1, n = 0; n < a.length; n++)
            if (a[n].identifier === t) {
                e = n;
                break
            } return e
    }

    function c(t, e) {
        for (var n = {}, i = [], o = 0; o < t.length; o++) {
            var r = t[o],
                c = e.base ? r[0] + e.base : r[0],
                l = n[c] || 0,
                u = "".concat(c, " ").concat(l);
            n[c] = l + 1;
            var d = s(u),
                p = {
                    css: r[1],
                    media: r[2],
                    sourceMap: r[3]
                }; - 1 !== d ? (a[d].references++, a[d].updater(p)) : a.push({
                identifier: u,
                updater: g(p, e),
                references: 1
            }), i.push(u)
        }
        return i
    }

    function l(t) {
        var e = document.createElement("style"),
            i = t.attributes || {};
        if (void 0 === i.nonce) {
            var o = n.nc;
            o && (i.nonce = o)
        }
        if (Object.keys(i).forEach((function (t) {
                e.setAttribute(t, i[t])
            })), "function" == typeof t.insert) t.insert(e);
        else {
            var a = r(t.insert || "head");
            if (!a) throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
            a.appendChild(e)
        }
        return e
    }
    var u, d = (u = [], function (t, e) {
        return u[t] = e, u.filter(Boolean).join("\n")
    });

    function p(t, e, n, i) {
        var o = n ? "" : i.media ? "@media ".concat(i.media, " {").concat(i.css, "}") : i.css;
        if (t.styleSheet) t.styleSheet.cssText = d(e, o);
        else {
            var r = document.createTextNode(o),
                a = t.childNodes;
            a[e] && t.removeChild(a[e]), a.length ? t.insertBefore(r, a[e]) : t.appendChild(r)
        }
    }

    function v(t, e, n) {
        var i = n.css,
            o = n.media,
            r = n.sourceMap;
        if (o ? t.setAttribute("media", o) : t.removeAttribute("media"), r && "undefined" != typeof btoa && (i += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(r)))), " */")), t.styleSheet) t.styleSheet.cssText = i;
        else {
            for (; t.firstChild;) t.removeChild(t.firstChild);
            t.appendChild(document.createTextNode(i))
        }
    }
    var f = null,
        w = 0;

    function g(t, e) {
        var n, i, o;
        if (e.singleton) {
            var r = w++;
            n = f || (f = l(e)), i = p.bind(null, n, r, !1), o = p.bind(null, n, r, !0)
        } else n = l(e), i = v.bind(null, n, e), o = function () {
            ! function (t) {
                if (null === t.parentNode) return !1;
                t.parentNode.removeChild(t)
            }(n)
        };
        return i(t),
            function (e) {
                if (e) {
                    if (e.css === t.css && e.media === t.media && e.sourceMap === t.sourceMap) return;
                    i(t = e)
                } else o()
            }
    }
    t.exports = function (t, e) {
        (e = e || {}).singleton || "boolean" == typeof e.singleton || (e.singleton = o());
        var n = c(t = t || [], e);
        return function (t) {
            if (t = t || [], "[object Array]" === Object.prototype.toString.call(t)) {
                for (var i = 0; i < n.length; i++) {
                    var o = s(n[i]);
                    a[o].references--
                }
                for (var r = c(t, e), l = 0; l < n.length; l++) {
                    var u = s(n[l]);
                    0 === a[u].references && (a[u].updater(), a.splice(u, 1))
                }
                n = r
            }
        }
    }
}, function (t, e, n) {
    "use strict";
    t.exports = function (t) {
        var e = [];
        return e.toString = function () {
            return this.map((function (e) {
                var n = function (t, e) {
                    var n = t[1] || "",
                        i = t[3];
                    if (!i) return n;
                    if (e && "function" == typeof btoa) {
                        var o = (a = i, s = btoa(unescape(encodeURIComponent(JSON.stringify(a)))), c = "sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(s), "/*# ".concat(c, " */")),
                            r = i.sources.map((function (t) {
                                return "/*# sourceURL=".concat(i.sourceRoot || "").concat(t, " */")
                            }));
                        return [n].concat(r).concat([o]).join("\n")
                    }
                    var a, s, c;
                    return [n].join("\n")
                }(e, t);
                return e[2] ? "@media ".concat(e[2], " {").concat(n, "}") : n
            })).join("")
        }, e.i = function (t, n, i) {
            "string" == typeof t && (t = [
                [null, t, ""]
            ]);
            var o = {};
            if (i)
                for (var r = 0; r < this.length; r++) {
                    var a = this[r][0];
                    null != a && (o[a] = !0)
                }
            for (var s = 0; s < t.length; s++) {
                var c = [].concat(t[s]);
                i && o[c[0]] || (n && (c[2] ? c[2] = "".concat(n, " and ").concat(c[2]) : c[2] = n), e.push(c))
            }
        }, e
    }
}, function (t, e, n) {
    "use strict";
    n.r(e), n.d(e, "isFullscreen", (function () {
        return i
    })), n.d(e, "isPlaying", (function () {
        return o
    })), n.d(e, "getAvatar", (function () {
        return r
    })), n.d(e, "getWidgetPosition", (function () {
        return a
    })), n.d(e, "formatGloss", (function () {
        return s
    })), n.d(e, "getWidget", (function () {
        return c
    })), n.d(e, "setWidgetPosition", (function () {
        return l
    })), n.d(e, "$", (function () {
        return u
    })), n.d(e, "$$", (function () {
        return d
    })), n.d(e, "$0", (function () {
        return p
    })), n.d(e, "hasClass", (function () {
        return v
    })), n.d(e, "addClass", (function () {
        return f
    })), n.d(e, "getDocumentDim", (function () {
        return w
    })), n.d(e, "removeClass", (function () {
        return g
    })), n.d(e, "toggleClass", (function () {
        return h
    })), n.d(e, "getRect", (function () {
        return b
    })), n.d(e, "addClickBlocker", (function () {
        return m
    })), n.d(e, "canTranslate", (function () {
        return y
    })), n.d(e, "toggleUnityMainLoop", (function () {
        return x
    })), n.d(e, "disableControlsButton", (function () {
        return L
    })), n.d(e, "_on", (function () {
        return T
    })), n.d(e, "_off", (function () {
        return C
    })), n.d(e, "_vwOn", (function () {
        return E
    })), n.d(e, "_vwOff", (function () {
        return O
    }));
    const i = () => v(document.body, "vpw-fullscreen"),
        o = () => v(u("div[vp-controls]"), "vpw-playing"),
        r = () => window.plugin.player.avatar,
        a = () => window.plugin ? window.plugin.position : void 0,
        s = t => -1 != t.indexOf("&") ? t.replace("&", "(") + ")" : t,
        c = () => u("[vp]").closest("[vw]"),
        l = t => {
            window.dispatchEvent(new CustomEvent("vp-widget-wrapper-set-side", {
                detail: t
            }))
        },
        u = (t, e = null) => e ? e.querySelector(t) : u(t, document),
        d = (t, e = null) => e ? e.querySelectorAll(t) : d(t, document),
        p = document.body,
        v = (t, e) => t ? t.classList.contains(e) : void 0,
        f = (t, e) => {
            t.classList.add(e)
        },
        w = () => {
            const {
                clientWidth: t,
                clientHeight: e
            } = document.documentElement;
            return {
                w: t,
                h: e
            }
        },
        g = (t, e) => {
            t.classList.remove(e)
        },
        h = (t, e, n) => {
            t.classList.toggle(e, n)
        },
        b = t => t.getBoundingClientRect(),
        m = t => {
            h(u(".vpw-skip-welcome-message"), "vp-disabled", t), h(u("[vp-click-blocker]"), "vp-enabled", t)
        },
        y = () => v(u("[vp-controls]"), "vpw-controls") && !v(u(".vp-guide-container"), "vp-enabled") && v(u("[vw-plugin-wrapper]"), "active"),
        x = t => {
            t ? window.plugin.player.player.Module.resumeMainLoop() : window.plugin.player.player.Module.pauseMainLoop()
        },
        L = (t = !0) => {
            t ? u("[vp-controls] .vpw-controls-button").setAttribute("disabled", !0) : u("[vp-controls] .vpw-controls-button").removeAttribute("disabled")
        },
        T = (t, e, n) => {
            t.addEventListener(e, n)
        },
        C = (t, e, n) => {
            t.removeEventListener(e, n)
        },
        E = (t, e, n) => {
            t.addListener(e, n)
        },
        O = (t, e, n) => {
            t.removeListener(e, n)
        }
}, function (t, e) {
    t.exports = {
        ROOT_PATH: "https://www.vlibras.gov.br/app/",
        DICTIONARY_URL: "https://dicionario2.vlibras.gov.br/signs?version=2018.3.1",
        REVIEW_URL: "https://traducao2.vlibras.gov.br/review",
        SIGNS_URL: "https://dicionario2.vlibras.gov.br/bundles",
        ACCESS_COUNT_URL: "https://acessos.vlibras.gov.br/plugin"
    }
}, function (t, e, n) {
    "use strict";
    n.r(e), n.d(e, "Widget", (function () {
        return i
    }));
    const i = n(5)
}, function (t, e, n) {
    const i = n(6),
        o = n(10);
    n(14);
    const {
        $: r,
        $$: a,
        addClass: s,
        toggleUnityMainLoop: c,
        removeClass: l,
        getWidget: u
    } = n(2), {
        ROOT_PATH: d
    } = n(3), p = ["TL", "T", "TR", "L", "R", "BL", "B", "BR"], v = ["icaro", "hosana", "guga", "random"];
    t.exports = function (...t) {
        const e = "object" == typeof t[0] && t[0],
            n = e ? e.personalization : t[1];
        let f = e ? e.rootPath : t[0],
            w = e ? e.position : t[3],
            g = e ? e.opacity : t[2],
            h = e.avatar;
        void 0 === f ? f = d : f && !f.endsWith("/") && (f += "/"), (isNaN(g) || g < 0 || g > 1) && (g = 1), p.includes(w) || (w = "R"), v.includes(h) || (h = "icaro");
        const b = new o,
            m = new i({
                rootPath: f,
                pluginWrapper: b,
                personalization: n,
                opacity: g,
                position: w,
                avatar: h
            });
        let y;
        window.onload && (y = window.onload), window.onload = () => {
            a("[vw]").forEach(t => {
                r("[vp]"), t || (t.removeAttribute("vw"), location.hostname.includes("correios.com.br") && l(t, "enabled"))
            }), y && y(), this.element = r("[vw-plugin-wrapper]").closest("[vw]");
            const t = r("[vw-plugin-wrapper]"),
                e = r("[vw-access-button]");
            m.load(r("[vw-access-button]"), this.element), b.load(r("[vw-plugin-wrapper]")), window.addEventListener("vp-widget-wrapper-set-side", t => {
                const e = t.detail;
                if (!e || !p.includes(e)) return;
                this.element = u(), this.element.style.left = e.includes("L") ? "0" : ["T", "B"].includes(e) ? "50%" : "initial", this.element.style.right = e.includes("R") ? "0" : "initial", this.element.style.top = e.includes("T") ? "0" : ["L", "R"].includes(e) ? "50%" : "initial", this.element.style.bottom = e.includes("B") ? "0" : "initial", this.element.style.transform = ["L", "R"].includes(e) ? "translateY(calc(-50% - 10px))" : ["T", "B"].includes(e) ? "translateX(calc(-50% - 10px))" : "initial";
                const n = r("[vw-access-button]");
                n.classList.toggle("isLeft", e.includes("L")), n.classList.toggle("isTopOrBottom", "TB".includes(e)), window.plugin && (window.plugin.position = e)
            }), a("img[data-src]", this.element).forEach(t => {
                const e = t.attributes["data-src"].value;
                t.src = f ? f + "/" + e : e
            }), window.addEventListener("vp-widget-close", n => {
                e.classList.toggle("active"), t.classList.toggle("active"), s(r("div[vp-change-avatar]"), "active"), s(r("div[vp-additional-options]"), "vp-enabled"), l(r("div[vp-controls]"), "vpw-selectText"), c(!1)
            }), window.addEventListener("vw-change-opacity", e => {
                t.style.background = `rgba(235,235,235, ${e.detail})`
            }), p.includes(w) && window.dispatchEvent(new CustomEvent("vp-widget-wrapper-set-side", {
                detail: w
            }))
        }
    }
}, function (t, e, n) {
    const i = n(7).default;
    n(8);
    const {
        canTranslate: o,
        toggleUnityMainLoop: r
    } = n(2);

    function a(t) {
        this.personalization = t.personalization, this.rootPath = t.rootPath, this.enableWelcome = t.enableWelcome, this.pluginWrapper = t.pluginWrapper, this.opacity = t.opacity, this.position = t.position, this.avatar = t.avatar, this.vw_links = null, this.currentElement = null, this.currentSpanElement = null, this.ready = !1
    }
    a.prototype.load = function (t, e) {
        this.element = t, this.element.innerHTML = i, this.element.addEventListener("click", async () => {
            this.element.classList.toggle("active"), this.pluginWrapper.element.classList.toggle("active"), this.ready && r(!0);
            const {
                Plugin: t
            } = await n.e(0).then(n.bind(null, 17)), {
                loadTextCaptureScript: e
            } = await n.e(0).then(n.bind(null, 18));
            window.VLibras.Plugin = t;
            const i = {
                enableMoveWindow: !0,
                enableWelcome: !0,
                personalization: this.personalization,
                wrapper: this.pluginWrapper.element,
                position: this.position,
                rootPath: this.rootPath,
                opacity: this.opacity,
                avatar: this.avatar
            };
            if (window.plugin || (window.plugin = new window.VLibras.Plugin(i)), this.ready) e();
            else {
                const t = setInterval(() => {
                    o() && (e(), this.ready = !0, clearInterval(t))
                }, 1e3)
            }
        })
    }, t.exports = a
}, function (t, e, n) {
    "use strict";
    n.r(e), e.default = '<img class="access-button" data-src="assets/access_icon.svg"\r\n    alt="Conteúdo acessível em Libras usando o VLibras Widget com opções dos Avatares Ícaro, Hosana ou Guga." />\r\n<img class="pop-up" data-src="assets/access_popup.jpg"\r\n    alt="Conteúdo acessível em Libras usando o VLibras Widget com opções dos Avatares Ícaro, Hosana ou Guga." />'
}, function (t, e, n) {
    var i = n(0),
        o = n(9);
    "string" == typeof (o = o.__esModule ? o.default : o) && (o = [
        [t.i, o, ""]
    ]);
    var r = {
        insert: "head",
        singleton: !1
    };
    i(o, r);
    t.exports = o.locals || {}
}, function (t, e, n) {
    (e = n(1)(!1)).push([t.i, "[vw] [vw-access-button]{display:none;flex-direction:row-reverse;width:40px;height:40px;cursor:pointer;overflow:hidden;position:absolute;border-radius:8px;transition:all .5s ease;right:0;left:auto}[vw] [vw-access-button] img{max-height:40px;transition:all .5s ease;border-radius:8px;opacity:1 !important;visibility:visible !important}[vw] [vw-access-button] .access-button{width:40px;height:40px;z-index:1}[vw] [vw-access-button] .pop-up{position:absolute;height:40px;min-width:150px;z-index:0;left:0;right:auto}[vw] [vw-access-button]:hover{width:200px}[vw] [vw-access-button].isLeft{flex-direction:row;left:0;right:auto}[vw] [vw-access-button].isLeft .pop-up{left:auto;right:0}[vw] [vw-access-button].isTopOrBottom:hover{bottom:-20px;top:0;margin-right:-80px}[vw] [vw-access-button].active{display:flex}\n", ""]), t.exports = e
}, function (t, e, n) {
    const i = n(11).default;

    function o() {}
    n(12), o.prototype.load = function (t) {
        this.element = t, this.element.innerHTML = i
    }, t.exports = o
}, function (t, e, n) {
    "use strict";
    n.r(e), e.default = "<div vp>\r\n  <div vp-box></div>\r\n  <div vp-message-box></div>\r\n  <div vp-settings></div>\r\n  <div vp-dictionary></div>\r\n  <div vp-settings-btn></div>\r\n  <div vp-info-screen></div>\r\n  <div vp-suggestion-screen></div>\r\n  <div vp-translator-screen></div>\r\n  <div vp-main-guide-screen></div>\r\n  <div vp-suggestion-button></div>\r\n  <div vp-rate-box></div>\r\n  <div vp-change-avatar></div>\r\n  <div vp-additional-options></div>\r\n  <div vp-controls></div>\r\n  <span vp-click-blocker></span>\r\n</div>"
}, function (t, e, n) {
    var i = n(0),
        o = n(13);
    "string" == typeof (o = o.__esModule ? o.default : o) && (o = [
        [t.i, o, ""]
    ]);
    var r = {
        insert: "head",
        singleton: !1
    };
    i(o, r);
    t.exports = o.locals || {}
}, function (t, e, n) {
    (e = n(1)(!1)).push([t.i, "[vw].left [vw-plugin-wrapper]{float:left}[vw] [vw-plugin-wrapper]{position:relative;display:none;width:300px;height:100%;float:right;background:white;-webkit-box-shadow:0px 0px 15px rgba(0,0,0,0.2);-moz-box-shadow:0px 0px 15px rgba(0,0,0,0.2);box-shadow:0px 0px 15px rgba(0,0,0,0.2);border-radius:12px;-moz-border-radius:12px;-webkit-border-radius:12px}[vw] [vw-plugin-wrapper].active{display:-webkit-flex;display:flex;flex-direction:column;-webkit-flex-direction:column;height:450px;max-width:100%;min-height:100%}\n", ""]), t.exports = e
}, function (t, e, n) {
    var i = n(0),
        o = n(15);
    "string" == typeof (o = o.__esModule ? o.default : o) && (o = [
        [t.i, o, ""]
    ]);
    var r = {
        insert: "head",
        singleton: !1
    };
    i(o, r);
    t.exports = o.locals || {}
}, function (t, e, n) {
    (e = n(1)(!1)).push([t.i, "div[vw]{position:fixed;max-width:95vw;min-height:40px;min-width:40px;right:0;top:50%;transform:translateY(-50%);z-index:2147483647 !important;display:none;margin:10px !important}div[vw].enabled{display:block}div[vw].active{margin-top:-285px}div[vw].left{left:0;right:initial}\n", ""]), t.exports = e
}, function (t, e) {
    t.exports = window.window
}]);