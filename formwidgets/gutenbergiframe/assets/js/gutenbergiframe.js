/*
 * Rich text editor with blocks form field control (WYSIWYG)
 *
 * Data attributes:
 * - data-control="gutenberg" - enables the rich editor plugin
 *
 * JavaScript API:
 * $('input').gutenberg()
 *
 */
+(function ($) {
    "use strict";
    var Base = $.oc.foundation.base,
        BaseProto = Base.prototype;

    // GUTENBERG CLASS DEFINITION
    // ============================

    var GutenbergIframe = function (element, options) {
        this.options = options;
        this.$el = $(element);
        this.$form = this.$el.closest("form");
        this.id = this.$el.data("id");

        $.oc.foundation.controlUtils.markDisposable(element);

        Base.call(this);

        this.init();
    };

    GutenbergIframe.prototype = Object.create(BaseProto);
    GutenbergIframe.prototype.constructor = GutenbergIframe;

    GutenbergIframe.prototype.init = function () {
        // this.$masterTabs = $('#pages-master-tabs')

        /*
         * Input must have an identifier
         */
        if (!this.$el.attr("id")) {
            this.$el.attr(
                "id",
                "element-" + Math.random().toString(36).substring(7)
            );
        }

        if (this.options.minheight === 0) {
            var mHeight = "100%";
        } else {
            var mHeight = this.options.minheight + "px";
        }

        /**
         * First we need to remove old instance and create new one,
         * gutenberg.js can't initialize multiple instances of editor on one page.
         */
        // if (!window.Laraberg.editor){

        // }
        this.initProxy();
    };

    /*
     * Instantly synchronizes HTML content.
     */
    GutenbergIframe.prototype.onFormBeforeRequest = function (ev) {
        $("input[id=" + this.id + "]").val(
            this.$el[0].contentWindow.Laraberg.getContent()
        );
    };
    GutenbergIframe.prototype.triggersave = function (ev) {
        console.log(this.$el);
        $("input[id=" + this.id + "]").val(
            this.$el[0].contentWindow.Laraberg.getContent()
        );
        this.$el
            .parents("[data-control=formwidget]")
            .find('[data-request="onSave"]')
            .click();
    };

    GutenbergIframe.prototype.initProxy = function () {
        $(this.$form).on(
            "oc.beforeRequest",
            this.proxy(this.onFormBeforeRequest)
        );

        $(window).on("savetrigger", this.proxy(this.triggersave));
        // wp.data.subscribe(() => {
        //     console.log(Laraberg.getContent());
        // });
        // this.$masterTabs.on('shown.bs.tab', this.proxy(this.onTabShown))
    };

    /*
     * Triggered when a tab is displayed.
     */
    // Gutenberg.prototype.onTabShown = function(e) {
    //     Laraberg.remove(this.$el.attr('id'), { minHeight: '300px', laravelFilemanager: true })
    // }

    // GUTENBERG PLUGIN DEFINITION
    // ============================

    var old = $.fn.gutenbergifame;

    $.fn.gutenbergifame = function (option) {
        var args = Array.prototype.slice.call(arguments, 1),
            result;
        this.each(function () {
            var $this = $(this);
            var data = $this.data("oc.gutenbergifame");
            var options = $.extend(
                {},
                GutenbergIframe.DEFAULTS,
                $this.data(),
                typeof option == "object" && option
            );
            if (!data)
                $this.data(
                    "oc.gutenbergifame",
                    (data = new GutenbergIframe(this, options))
                );
            if (typeof option == "string")
                result = data[option].apply(data, args);
            if (typeof result != "undefined") return false;
        });

        return result ? result : this;
    };

    $.fn.gutenbergifame.Constructor = GutenbergIframe;

    // GUTENBERG NO CONFLICT
    // =================

    $.fn.gutenbergifame.noConflict = function () {
        $.fn.gutenbergifame = old;
        return this;
    };

    // GUTENBERG DATA-API
    // ===============

    $(document).render(function () {
        $('[data-control="gutenberg-iframe"]').gutenbergifame();
    });
})(window.jQuery);
