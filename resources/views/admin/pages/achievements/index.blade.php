@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Achievements</h3>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible mx-3 mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.achievements.update') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="competition_wins">Competition Wins</label>
                                <input type="number"
                                       class="form-control @error('competition_wins') is-invalid @enderror"
                                       id="competition_wins"
                                       name="competition_wins"
                                       value="{{ old('competition_wins', $achievement->competition_wins) }}"
                                       min="0"
                                       required>
                                @error('competition_wins')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="best_in_shows">Best in Shows</label>
                                <input type="number"
                                       class="form-control @error('best_in_shows') is-invalid @enderror"
                                       id="best_in_shows"
                                       name="best_in_shows"
                                       value="{{ old('best_in_shows', $achievement->best_in_shows) }}"
                                       min="0"
                                       required>
                                @error('best_in_shows')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="champions">Champions</label>
                                <input type="number"
                                       class="form-control @error('champions') is-invalid @enderror"
                                       id="champions"
                                       name="champions"
                                       value="{{ old('champions', $achievement->champions) }}"
                                       min="0"
                                       required>
                                @error('champions')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="international_shows">International Shows</label>
                                <input type="number"
                                       class="form-control @error('international_shows') is-invalid @enderror"
                                       id="international_shows"
                                       name="international_shows"
                                       value="{{ old('international_shows', $achievement->international_shows) }}"
                                       min="0"
                                       required>
                                @error('international_shows')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Achievements
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
