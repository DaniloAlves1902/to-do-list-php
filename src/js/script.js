$(document).ready(function () {
  $(".edit-button").on("click", function () {
    var $task = $(this).closest(".task");
    $task.find(".progress").addClass("hidden");
    $task.find(".task-description").addClass("hidden");
    $task.find(".task-actions").addClass("hidden");
    $task.find(".edit-task").removeClass("hidden");
  });

  $(".progress").on("click", function () {
    if ($(this).is(":checked")) {
      $(this).addClass("done");
    } else {
      $(this).removeClass("done");
    }
  });

  $(".progress").on("change", function () {
    const id = $(this).data("task-id");
    const completed = $(this).is(":checked");

    $.ajax({
      url: "actions/update-progress.php",
      method: "POST",
      data: {
        id: id,
        completed: completed ? 1 : 0,
      },
      dataType: "json",
      success: function (response) {
        if (!response.success) {
          alert("Erro ao editar a tarefa.");
        }
      },
      error: function () {
        alert("Erro na requisição.");
      },
    });
  });
});
