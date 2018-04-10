Kanboard.BoardPolling = function(app) {
    this.app = app;
};

Kanboard.BoardPolling.prototype.execute = function() {
    if (this.app.hasId("board")) {
        var interval = parseInt($("#board").attr("data-check-interval"));

        if (interval > 0) {
            window.setInterval(this.check.bind(this), interval * 1000);
        }
    }
};

Kanboard.BoardPolling.prototype.check = function() {
    if (KB.utils.isVisible() && !this.app.get("BoardDragAndDrop").savingInProgress) {
        var self = this;
        if (!$("#app-loading-icon").length) this.app.showLoadingIcon();
        var pollsinprogress=0;

        $("table.board-project").each(function() {
            var boardId = $(this).attr("data-project-id")            
            var url = $(this).attr("data-check-url");
            pollsinprogress++;
            $.ajax({
                cache: false,
                url: url,
                statusCode: {
                    200: function(data) {                        
                        pollsinprogress--;
                        if (pollsinprogress <= 0) self.app.hideLoadingIcon();
                        self.app.get("BoardDragAndDrop").refresh(boardId, data);
                    },
                    304: function () {
                        pollsinprogress--;
                        if (pollsinprogress <= 0) self.app.hideLoadingIcon();
                    }
                }
            });
        });
        if (pollsinprogress <= 0) self.app.hideLoadingIcon();
    }
};
